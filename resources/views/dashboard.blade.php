@extends('layouts.app')

@section('title', 'Dashboard - The Agni Canvas')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to bottom right, #fbe8ff, #e1e7fa);
        font-family: 'Segoe UI', sans-serif;
    }

    .brand-title {
        font-size: 3rem;
        color: #6f42c1;
        font-weight: bold;
    }

    .product-card {
        border: none;
        transition: transform 0.3s ease;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .product-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        object-position: center;
        background-color: #f8f8f8;
    }

    .btn-custom {
        margin: 5px 3px;
    }
</style>
@endpush

@section('content')
<div class="container text-center mt-5" data-aos="fade-up">
    <h1 class="brand-title">The Agni Canvas</h1>
    <p class="lead text-muted">
        Selamat datang kembali, {{ Auth::user()->name }}! <br>
        Anda sedang berada di ruang digital, tempat keindahan dan ekspresi dituangkan dalam karya seni. <br>
        Temukan beragam koleksi lukisan eksklusif, melalui tampilan dashboard kami yang elegan dan intuitif.
    </p>
</div>

<div class="container my-5">
    <h3 class="text-center mb-4" data-aos="fade-up">Produk Unggulan</h3>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4" data-aos="zoom-in">
                <div class="card product-card h-100">
                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">

                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted small">{{ $product->description }}</p>
                        <p class="text-danger fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mt-auto">
                            <!-- Tombol Tambah ke Keranjang (AJAX) -->
                            <button 
                                class="btn btn-outline-primary btn-sm btn-custom add-to-cart-btn"
                                data-product-id="{{ $product->id }}">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>

                            <!-- Tombol Beli Sekarang -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm btn-custom">
        <i class="bi bi-bag-check"></i> Beli Sekarang
    </button>
</form>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada produk tersedia.</p>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.add-to-cart-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;

                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        alert('Produk berhasil ditambahkan ke keranjang!');
                    } else {
                        alert('Gagal menambahkan ke keranjang.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Terjadi kesalahan.');
                });
            });
        });
    });
</script>
@endpush
