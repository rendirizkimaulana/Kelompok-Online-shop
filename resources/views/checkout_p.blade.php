@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Keranjang Anda</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <img style="width: 90px; margin-right: 1rem !important;" class="img-fluid img-thumbnail"
                            src="{{ asset('assets') }}/{{ $data_baju->gambar }}" alt="">
                        <div>
                            <h6 class="my-0">{{ $data_baju->nama }}</h6>
                            <small class="text-muted">Ukuran: {{ $size->size }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total </span>
                        <strong>Rp. {{ number_format($size->harga, 0, ',', '.') }}</strong>
                    </li>
                </ul>
                <button class="w-100 btn btn-primary btn-lg" type="button" id="pay-button">Lanjutkan Pembayaran</button>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Alamat pembayaran </h4>
                <form class="needs-validation" id="payment-form" novalidate>
                    <input type="hidden" name="amount" id="amount" value="{{ $size->harga }}">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="first_name" class="form-label">Nama depan</label>
                            <input type="text" class="form-control" id="first_name" placeholder="" value=""
                                required>

                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Nama belakang</label>
                            <input type="text" class="form-control" id="last_name" placeholder="" value=""
                                required>

                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <span
                                    class="text-muted">(Diperlukan)</span></label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com"
                                required>
                            <small>Kami tidak akan pernah berbagi email Anda dengan siapa pun.</small>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Nomor <span
                                    class="text-muted">(Diperlukan)</span></label>
                            <input type="number" class="form-control" id="phone" placeholder="08XXXXXXXXXX" required
                                min="10">
                            <small>Kami tidak akan pernah berbagi nomor Anda dengan siapa pun.</small>
                        </div>
                        <div class="col-8">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        </div>

                        <div class="col-4">
                            <label for="zip" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#payment-form').on('input', function() {
                var formFilled = true;
                $('#payment-form input').each(function() {
                    if ($(this).val() === '') {
                        formFilled = false;
                        return false;
                    }
                });

                if (formFilled) {
                    $('#pay-button').prop('disabled', false);
                } else {
                    $('#pay-button').prop('disabled', true);
                }
            });
            $('#payment-form').trigger('input');
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '#pay-button', function() {
            $.ajax({
                url: '{{ route('snap.create') }}',
                method: 'POST',
                data: {
                    harga: $('#amount').val(),
                    nama_depan: $('#first_name').val(),
                    nama_belakang: $('#last_name').val(),
                    email: $('#email').val(),
                    no_telp: $('#phone').val(),
                    alamat: $('#address').val(),
                    zip: $('#zip').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            Swal.fire({
                                title: 'Transaksi Berhasil',
                                text: 'Pesan anda sedang diproses...',
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                url: '{{ route('snap.store_') }}',
                                method: 'POST',
                                data: {
                                    id_produk: '{{ $data_baju->id }}',
                                    id_size: '{{ $size->id }}',
                                    transaction_id: result.transaction_id,
                                    order_id: result.order_id,
                                    transaction_time: result.transaction_time,
                                    total_bayar: result.gross_amount,
                                    alamat: $('#address').val(),
                                    tipe_bayar: result.payment_type,
                                    status: result.transaction_status,
                                    email: $('#email').val(),
                                    user_id: '{{ Auth::user()->id }}',
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    if (data.status == 'success') {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Pesan Berhasil",
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            timer: 1500
                                        });
                                        window.location.href = "{{ route('profile') }}";
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Pesan Gagal Diproses",
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            timer: 1500
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Pesan Gagal Diproses",
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        timer: 1500
                                    });
                                }
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                icon: "warning",
                                title: "Silahkan Kontak customer service kami",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                            $.ajax({
                                url: '{{ route('snap.store_') }}',
                                method: 'POST',
                                data: {
                                    id_produk: '{{ $data_baju->id }}',
                                    id_size: '{{ $size->id }}',
                                    transaction_id: result.transaction_id,
                                    order_id: result.order_id,
                                    transaction_time: result.transaction_time,
                                    total_bayar: result.gross_amount,
                                    alamat: $('#address').val(),
                                    tipe_bayar: result.payment_type,
                                    status: result.transaction_status,
                                    email: $('#email').val(),
                                    user_id: '{{ Auth::user()->id }}',
                                    _token: '{{ csrf_token() }}'
                                }
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: "error",
                                title: "Pesan Gagal Diproses",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                            $.ajax({
                                url: '{{ route('snap.store_') }}',
                                method: 'POST',
                                data: {
                                    id_produk: '{{ $data_baju->id }}',
                                    id_size: '{{ $size->id }}',
                                    transaction_id: result.transaction_id,
                                    order_id: result.order_id,
                                    transaction_time: result.transaction_time,
                                    total_bayar: result.gross_amount,
                                    alamat: $('#address').val(),
                                    tipe_bayar: result.payment_type,
                                    status: result.transaction_status,
                                    email: $('#email').val(),
                                    user_id: '{{ Auth::user()->id }}',
                                    _token: '{{ csrf_token() }}'
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Pesan Gagal Diproses",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1500
                    });
                }
            });
        });
    </script>
@endsection
