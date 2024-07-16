<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
<header class="main-header py-4">
    <div class="container">
        <div class="logo text-left">
            <h1>Fashion Hub Product</h1>
        </div>
    </div>
</header>

    <main>
    <!-- Featured Products Section -->
    <section class="featured-products py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Product Card 1 -->

                @foreach ($data_baju as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('assets/') }}/{{ $product->gambar }}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                                    <p class="card-text">{{ substr($product->deskripsi, 0, 30) }}...</p>
                                    <a href="{{ route('detail_p', encrypt($product->id)) }}" class="btn btn-primary">View
                                        Details</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</main>

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
