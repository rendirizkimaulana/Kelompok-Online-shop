@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Tambah</h3>
            <hr>
            <form action="{{ route('store_file.admin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="nama_produk">Nama</label>
                <input type="text" class="form-control mb-3" name="input_urai" id="nama_produk"
                    value="{{ $data_produk->nama ?? '' }}">
                <label for="ukuran">Deskripsi</label>
                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $data_produk->deskripsi ?? '' }}</textarea>
                <label for="gambar">Gambar Produk</label>
                <input type="file" class="form-control mb-3" name="input_nama_file" id="gambar" required>
                <input type="hidden" name="id" id="" value="{{ $data_produk->id ?? '' }}">

                <hr>
                
                <h3>Tipe Konten</h3>
                <select name="input_tipe_upload" id="" class="form-select">
                    <option value="Slider">Slider</option>
                    <option value="Tentang">Tentang Kami</option>
                </select>
                <button class="btn btn-primary mt-3" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endSection
