<!-- resources/views/about.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <section class="about-section">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('berkas_upload') }}/{{ $data_tentang->nama_file }}" class="img-fluid rounded" alt="Online Shop Logo">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">About Us</h2>
                <p class="section-description">{{ $data_tentang->deskripsi }}</p>
                
                <h2 class="section-title">Visi</h2>
                <p>VISI  : Menjadi pusat inspirasi global dalam dunia fashion, mengubah cara orang berbelanja menjadi pengalaman yang memikat dan membangun komunitas yang berbudaya</p>
                <h2 class="section-title">Misi</h2>
                <p>MISI : Inspirasi Tanpa Batas menghadirkan produk fashion terbaik dari seluruh dunia dan menggali bakat kreatif untuk menciptakan tren yang memukau. Kami menyajikan pengalaman belanja yang tak terlupakan dengan navigasi intuitif dan layanan pelanggan superior. Kami menjadi rumah bagi semua orang tanpa memandang latar belakang, mendorong inklusivitas dalam bisnis kami. Kami juga berkomitmen pada keberlanjutan dengan memastikan dampak positif bagi lingkungan dan masyarakat, serta berkolaborasi dengan merek terkemuka, desainer berbakat, dan komunitas lokal untuk menciptakan nilai tambah dan pertumbuhan bersama dalam industri fashion.</p>
            </div>
        </div>
    </section>
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
