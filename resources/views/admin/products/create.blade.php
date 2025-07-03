@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="h4 mb-4 text-gray-800">Tambah Produk</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Detail Produk</label>
                    <textarea name="details" class="form-control" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Stok / Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Berat (gram)</label>
                    <input type="number" name="weight" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tag</label>
                    <select name="tags[]" class="form-control" multiple required>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Upload Gambar Produk</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Produk</button>
    </form>
</div>
@endsection
