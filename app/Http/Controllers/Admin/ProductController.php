<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {   
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::with('category', 'tags', 'firstMedia')->latest()->paginate(5); 

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::latest()->get(['id', 'name']);
        $tags = Tag::latest()->get(['id', 'name']);

        return view('admin.products.create', compact('categories','tags'));
    }

    public function store(ProductRequest $request)
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::create($request->except(['tags', 'images']));

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        if ($request->hasFile('images') && count($request->images) > 0) {
            $index = 1;
            (new ImageService())->storeProductImages($request->images, $product, $index);
        }

        return redirect()->route('admin.products.index')->with([
            'message' => 'Produk berhasil ditambahkan!',
            'alert-type' => 'success'
        ]);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $categories = Category::latest()->get(['id', 'name']);
        $tags = Tag::latest()->get(['id', 'name']);

        return view('admin.products.edit', compact('categories','product','tags'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->update($request->except(['tags', 'images', '_token', '_method']));

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        $index = $product->media()->count() + 1;

        if ($request->hasFile('images') && count($request->images) > 0) {
            (new ImageService())->storeProductImages($request->images, $product, $index);
        }

        return redirect()->route('admin.products.index')->with([
            'message' => 'Produk berhasil diupdate!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($product->media->count() > 0) {
            foreach ($product->media as $media) {
                (new ImageService())->unlinkImage($media->file_name, 'products');
                $media->delete();
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with([
            'message' => 'Produk berhasil dihapus!',
            'alert-type' => 'danger',
        ]);
    }

    public function removeImage(Request $request)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();

        (new ImageService())->unlinkImage($image->file_name, 'products');
        $image->delete();

        return true;
    }
}
