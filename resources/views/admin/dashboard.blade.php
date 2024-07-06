@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Transaksi
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table" id="tablex">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pesanan</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Tipe Pembayaran</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <h3 id="nama_barang"></h3>
                    <span class="badge bg-success" id="order_id"><span>6680f0014d70d</span></span>
                    <span class="badge bg-info" id="transaction_time"><span>2024-06-30 12:41:23</span></span>
                    <span class="badge bg-danger" id="tipe_bayar"><span>QRIS</span></span>
                    <a href="" id="linkmid" class="btn btn-primary"
                        style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"><i
                            class="bi bi-eye-fill"></i> Lihat di Midtrans</a>
                    <hr>
                    <p>Detail Produk</p>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody id="detail_produk">
                                <tr>
                                    <td><img src="" class="img-thumbnail" style="width: 150px" alt=""
                                            id="gambar_produk"></td>
                                    <td id="nama_produk"></td>
                                    <td id="ukuran"></td>
                                    <td id="harga"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>Detail Pembeli</p>
                    <div></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <td id="first_name"></td>
                            <td id="email"></td>
                            <td id="address"></td>
                            </tr>
                        </tbody>
                    </table>
                    <label for="ganti_status_transaksi" class="text-start form-label">
                        Ganti Status
                    </label>
                    <form action="{{ route('update-transaksi.admin') }}" method="POST" id="form_ganti_status" class="xform">
                        @csrf
                        <input type="hidden" name="input_order_id" id="input_order_id" class="form-control">
                        <select name="ganti_status_transaksi" id="ganti_status_transaksi" class="form-select">
                            <option value="Pesanan Dalam Proses">Pesanan Dalam Proses</option>
                            <option value="Pesanan sedang dikirim">Pesanan sedang dikirim</option>
                            <option value="Pesanan Selesai">Pesanan Selesai</option>
                            <option value="Pesanan Gagal">Pesanan Gagal</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            loadData()
        })

        loadData = function() {
            tablex = $('table#tablex').DataTable({
                responsive: true,
                searching: true,
                autoWidth: false,
                ordering: false,
                processing: true,
                serverSide: true,
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 250, 500, -1],
                    [5, 10, 25, 50, 100, 250, 500, "All"]
                ],
                pageLength: 50,
                ajax: {
                    url: "{{ route('data_penjualan.admin') }}",
                    data: function(data) {
                        data.id = '1';
                    }
                },
                drawCallback: function(settings) {

                    $('body').on('click', '.editProduct', function() {
                        $.ajax({
                            url: "{{ route('detail_transaksi.admin') }}",
                            data: {
                                id: $(this).data('id'),
                                _token: "{{ csrf_token() }}"
                            },
                            type: 'POST',
                            success: function(res) {

                                $('#modaldetail').modal('show');
                                $('#input_order_id').val(res.order_id);

                                $('.modal-title').html('Detail Transaksi');
                                $('#nama_produk').html(res.nama_produk);
                                $('#nama_barang').html(res.nama_produk);
                                $('#ukuran').html(res.size);

                                $('#transaction_time').html(res.transaction_time);
                                $('#tipe_bayar').html(res.tipe_bayar);

                                $('#first_name').html(res.name);
                                $('#email').html(res.email);
                                $('#address').html(res.alamat);

                                $('#harga').html('Rp. ' + new Intl.NumberFormat('id-ID')
                                    .format(res.total_bayar));
                                $('#gambar_produk').attr("src",
                                    "{{ asset('assets') }}/" + res.gambar);
                                $('#linkmid').attr("href",
                                    "https://dashboard.sandbox.midtrans.com/transactions/" +
                                    res.transaction_id);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    });

                },
                columns: [{
                        width: "5%",
                        className: 'fixed-side text-center',
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        }
                    },
                    {
                        width: "15%",
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return `<div>` + row.nama_produk +
                                `</div><div class="badge bg-success text-white">` + row.order_id +
                                `</div>`;
                        }
                    },
                    {
                        width: "10%",
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.transaction_time;

                        }
                    },
                    {
                        width: "15%",
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return `Rp. ${new Intl.NumberFormat('id-ID').format(row.total_bayar)}`;

                        }
                    },
                    {
                        width: "15%",
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.tipe_bayar;
                        }
                    },
                    {
                        width: "5%",
                        className: 'fixed-side text-center',
                        render: function(data, type, row) {
                            return row.email;

                        }
                    },
                    {
                        width: "15%",
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.status;

                        }
                    },
                    {
                        width: "5%",
                        className: 'fixed-side text-center',
                        render: function(data, type, row) {
                            return row.aksi
                        }
                    },

                ],
                createdRow: (row, data, index) => {

                }
            });
            tablex.on('draw', function() {
                $('[data-toggle="tooltip"]').tooltip()
            });
        };
    </script>
@endsection
