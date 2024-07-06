@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Tambah Produk</h3>
            <hr>
            <form action="{{ route('produk-tambah-transaksi.admin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control mb-3" name="nama_produk" id="nama_produk" value="{{ $data_produk->nama ?? '' }}">
                <label for="ukuran">Deskripsi</label>
                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $data_produk->deskripsi ?? '' }}
                </textarea>
                <label for="gambar">Gambar Produk</label>
                <input type="file" class="form-control mb-3" name="gambar" id="gambar" required>
                <hr>
                <h3>Ukuran</h3>
                <div class="mb-3">
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input value="S" disabled type="text" id="" class="form-control">
                                <input type="hidden" name="ukuran[]" id="" class="form-control" value="S">
                            </div>
                            <div class="col">
                                <label for="stok" class="form-label">Stok <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="stok[]" id="" class="form-control" value="{{ $stok['s']->stok ?? '' }}">
                            </div>
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="harga_satuan[]" id="" class="form-control" value="{{ $stok['s']->harga ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input value="M" disabled type="text" id="" class="form-control">
                                <input type="hidden" name="ukuran[]" id="" class="form-control"value="M" >
                            </div>
                            <div class="col">
                                <label for="stok" class="form-label">Stok <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="stok[]" id="" class="form-control" value="{{ $stok['m']->stok ?? ''}}">
                            </div>
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="harga_satuan[]" id="" class="form-control" value="{{ $stok['m']->harga ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input value="L" disabled type="text" id="" class="form-control">
                                <input type="hidden" name="ukuran[]" id="" class="form-control"value="L">
                            </div>
                            <div class="col">
                                <label for="stok" class="form-label">Stok <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="stok[]" id="" class="form-control" value="{{ $stok['l']->stok ?? ''}}">
                            </div>
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="harga_satuan[]" id="" class="form-control" value="{{ $stok['l']->harga ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input value="XL" disabled type="text" id="" class="form-control">
                                <input type="hidden" name="ukuran[]" id="" class="form-control"value="XL">
                            </div>
                            <div class="col">
                                <label for="stok" class="form-label">Stok <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="stok[]" id="" class="form-control" value="{{ $stok['xl']->stok ?? ''}}">
                            </div>
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="harga_satuan[]" id="" class="form-control"  value="{{ $stok['xl']->harga ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col">
                                <label for="ukuran" class="form-label">Ukuran <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input value="XXL" disabled type="text" id="" class="form-control">
                                <input type="hidden" name="ukuran[]" id="" class="form-control"value="XXL" >
                            </div>
                            <div class="col">
                                <label for="stok" class="form-label">Stok <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="stok[]" id="" class="form-control" value="{{ $stok['xxl']->stok ?? ''}}">
                            </div>
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan <span
                                        class="text-muted">(Diperlukan)</span></label>
                                <input type="number" name="harga_satuan[]" id="" class="form-control" value="{{ $stok['xxl']->harga ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="" value="{{ $data_produk->id ?? '' }}">
                <button class="btn btn-primary mt-3" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endSection
