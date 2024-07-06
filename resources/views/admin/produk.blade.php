@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <div class="row">
                    <div class="col">
                        Data Produk
                    </div>
                    <div class="col">
                        <a href="{{ route('tambah_produk.admin')}}" class="btn btn-primary float-end">Tambah Produk</a>
                    </div>
                </div>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table" id="tablex">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
$(document).ready(function() {
            $('body').on('click', '.deleteProduct', function() {
                if (confirm('Apakah anda yakin?')) {
                    $.ajax({
                        url: "{{ route('delete_.admin') }}",
                        data: {
                            id: $(this).data('id'),
                            table: 'm_produk',
                            _token: "{{ csrf_token() }}"
                        },
                        type: 'POST',
                        success: function(res) {
                            tablex = $('table#tablex').DataTable();
                            tablex.ajax.reload();
                        }
                    })
                }
            })
        });



        $(function() {
            loadData()
        });

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
                        data.id = '2';
                    }
                },
                drawCallback: function(settings) {

                },
                columns: [{
                        width: "5%",
                        className: 'fixed-side text-center',
                        render: function(data, type, row) {
                            return row.DT_RowIndex;
                        }
                    },
                    {
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return `<img class="img-thumbnail" width="200px" src="{{ asset('assets')}}/` + row.gambar + `">`;
                        }
                    },
                    {
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.nama_produk;
                        }
                    },
                    {
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.deskripsi;

                        }
                    },
                    {
                        width: "5%",
                        className: 'fixed-side text-center',
                        render: function(data, type, row) {
                            return row.aksi_b
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
