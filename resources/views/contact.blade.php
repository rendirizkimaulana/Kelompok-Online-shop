@extends('layouts.app')

@section('content')
<main>
    <section class="contact py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4">Contact Us</h2>
                    <p class="mb-4">
                    Tentang pengalaman berbelanja di toko online kami! Kami sangat menghargai setiap pelanggan dan berkomitmen untuk memberikan layanan terbaik. Jika Anda memiliki pertanyaan, masukan, atau membutuhkan bantuan, jangan ragu untuk menghubungi kami melalui formulir kontak di bawah ini. Kami akan merespons secepat mungkin.</p>

                    <h5 class="mb-3"><strong>Contact Information:</strong></h5>
                    <ul class="list-unstyled mb-4">
                        <li><i class="fas fa-phone me-2"></i> info@tokoonline.com</li>
                        <li><i class="fas fa-phone me-2"></i> +62 123 456 789</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Merdeka No. 123, Jakarta, Indonesia</li>
                    </ul>

                    <h5 class="mb-3"><strong>Business Hours:</strong></h5>
                    <ul class="list-unstyled">
                        <li>Monday - Friday: 09:00 - 18:00 WIB</li>
                        <li>Saturday: 10:00 - 14:00 WIB</li>
                        <li>Sunday and Public Holidays: Closed</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('assets/contac.jpg') }}" class="img-fluid rounded mb-4" alt="Online Shop Logo">
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
@endsection
