@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('/profile-image.png') }}" alt="Profile Image"
                                class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p>{{ Auth::user()->email }}</p>
                            <p>Terdaftar Sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Riwayat Transaksi</div>
        <div class="card-body">
            @forelse ($data_transaksi as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama }} - {{ $item->size }}</h5>
                    <div class="card-text">Tgl Transaksi: {{ $item->transaction_time }}</div>
                    <p class="card-text">Alamat: {{ $item->alamat }}</p>
                    <p class="card-text">Total: Rp. {{ number_format($item->total_bayar, 0, ',', '.') }}</p>
                    <p class="card-text badge bg-secondary">Status: {{ $item->status }}</p>
                </div>
            </div>
            @empty
            <p>Tidak ada riwayat transaksi.</p>
            @endforelse
        </div>
    </div>
</div>

<hr class="my-5">

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-content">
                    <h3>Online Shop</h3>
                    <p>Jelajahi katalog kami dan temukan inspirasi gaya untuk setiap kesempatan. Di Fashion Hub, kepuasan Anda adalah prioritas utama kami. Nikmati pengalaman berbelanja online yang menyenangkan dengan layanan pelanggan yang responsif dan pengiriman tepat waktu ke seluruh penjuru.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-content">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/products') }}">Products</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/teamproject') }}">Team</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-content">
                    <h3>Contact Us</h3>
                    <ul class="list-unstyled">
                        <li><span>Email:</span> info@tokoonline.com</li>
                        <li><span>Phone:</span> +62 123 456 789</li>
                        <li><span>Address:</span> Jl. Merdeka No. 123, Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection
