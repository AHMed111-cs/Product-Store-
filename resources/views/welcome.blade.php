@extends('layouts.app')

@section('content')
@php
    $heroImage = \DB::table('settings')->where('key', 'hero_image')->value('value');
@endphp

<!-- Hero Section -->
<div class="hero-section d-flex align-items-center justify-content-center text-center" style="min-height: 60vh; background: url('{{ $heroImage ? asset('storage/' . $heroImage) : asset('images/hero-bg.jpg') }}') center/cover no-repeat; position: relative;">
    <div style="background: rgba(0,0,0,0.45); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
    <div class="container position-relative" style="z-index:2;">
        <h1 class="display-2 fw-bold text-white mb-3">SUMMER <span style="font-family: 'Dancing Script', cursive;">Vibes</span></h1>
        <p class="lead text-white mb-4">Discover the latest summer clothing collections at the best prices</p>
        <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary px-5 shadow">Shop Now</a>
    </div>
</div>

<!-- روابط سريعة -->
<div class="container my-5">
    <div class="row text-center">
        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-tshirt fa-2x mb-2"></i>
                        <h6 class="card-title">كل المنتجات</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-male fa-2x mb-2"></i>
                        <h6 class="card-title">رجالي</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <a href="#" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-female fa-2x mb-2"></i>
                        <h6 class="card-title">نسائي</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <a href="#contact" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-phone fa-2x mb-2"></i>
                        <h6 class="card-title">تواصل معنا</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- Footer احترافي -->
<footer class="bg-dark text-white pt-4 pb-2 mt-5">
    <div class="container">
        <div class="row">
            <!-- روابط سريعة -->
            <div class="col-md-4 mb-3">
                <h5>روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white">الرئيسية</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white">المنتجات</a></li>
                    <li><a href="{{ route('login') }}" class="text-white">تسجيل الدخول</a></li>
                </ul>
            </div>
            <!-- معلومات التواصل -->
            <div class="col-md-4 mb-3" id="contact">
                <h5>معلومات التواصل</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> القاهرة، مصر</li>
                    <li><i class="fas fa-envelope"></i> info@yourshop.com</li>
                    <li><i class="fas fa-phone"></i> 0123456789</li>
                </ul>
            </div>
            <!-- سوشيال ميديا -->
            <div class="col-md-4 mb-3">
                <h5>تابعنا</h5>
                <a href="#" class="text-white me-2"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
        </div>
        <div class="text-center mt-3">
            جميع الحقوق محفوظة &copy; {{ date('Y') }}
        </div>
    </div>
</footer>
@endsection
