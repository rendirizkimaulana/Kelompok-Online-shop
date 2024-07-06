@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <div class="row">
                    <div class="col">
                        Data Slider Home
                    </div>
                    <div class="col">
                        <a href="{{ route('tambah_konten.admin')}}" class="btn btn-primary float-end">Tambah</a>
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
                            <th>Nama</th>
                            <th>Tipe</th>
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
                            table: 'berkas_upload',
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
                        data.id = '3';
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
                            return `<img class="img-thumbnail" width="200px" src="{{ asset('berkas_upload')}}/` + row.nama_file + `">`;
                        }
                    },
                    {
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.urai;
                        }
                    },
                    {
                        className: 'fixed-side text-left',
                        render: function(data, type, row) {
                            return row.tipe_upload;
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
                            return row.aksi_c
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
