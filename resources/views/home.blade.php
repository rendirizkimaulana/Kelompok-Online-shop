@extends('layouts.app')

@section('content')
    <main>
        <!-- Carousel Section -->
        <section class="carousel-section mb-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($berkas_upload as $product)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset('berkas_upload') }}/{{ $product->nama_file }}" class="d-block w-100"
                                alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="featured-products py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Featured Products</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($data_baju as $product)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('assets/') }}/{{ $product->gambar }}" class="card-img-top img-fluid"
                                    alt="Product Image">
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
                        <p>Jelajahi katalog kami dan temukan inspirasi gaya untuk setiap kesempatan. Di Fashion Hub,
                            kepuasan Anda adalah prioritas utama kami. Nikmati pengalaman berbelanja online yang
                            menyenangkan dengan layanan pelanggan yang responsif dan pengiriman tepat waktu ke seluruh
                            penjuru.</p>
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

    <style>
        .carousel-section {
            margin-left: -15px;
            margin-right: -15px;
        }

        .carousel-inner img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }

    </style>
@endsection
