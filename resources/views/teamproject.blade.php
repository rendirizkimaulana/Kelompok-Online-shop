@extends('layouts.app')

@section('content')
<main>
    <section class="team py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Our Team</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="team-member text-center mb-4">
                        <div class="member-img">
                            <img src="{{ asset('assets/rendi.jpeg') }}" class="img-fluid rounded-circle" alt="Team Member 1">
                        </div>
                        <h4>Rendi</h4>
                        <p class="text-muted">NIM 22.11.4657</p>
                        <p>frontend product dan backend-web</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center mb-4">
                        <div class="member-img">
                            <img src="{{ asset('assets/aulia.jpeg') }}" class="img-fluid rounded-circle" alt="Team Member 2">
                        </div>
                        <h4>Aulia</h4>
                        <p class="text-muted">NIM 21.11.4468</p>
                        <p>frontend home</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center mb-4">
                        <div class="member-img">
                            <img src="{{ asset('assets/indah.jpeg') }}" class="img-fluid rounded-circle" alt="Team Member 3">
                        </div>
                        <h4>Indah</h4>
                        <p class="text-muted">NIM 21.11.4621</p>
                        <p>frontend contac</p>     
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center mb-4">
                        <div class="member-img">
                            <img src="{{ asset('assets/osty.jpeg') }}" class="img-fluid rounded-circle" alt="Team Member 4">
                        </div>
                        <h4>Osty</h4>
                        <p class="text-muted">NIM 21.11.4610</p>
                        <p>frontend about</p>                   
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</main>

<style>
    .member-img img {
        width: 150px; /* Adjust the size as needed */
        height: 150px; /* Adjust the size as needed */
        object-fit: cover;
    }
</style>

@endsection
