@extends('layouts.app')

@section('title', 'Keranjang - The Agni Canvas')

@push('styles')
<style>
    body {
        background: linear-gradient(to bottom right, #fce4ec, #e8eaf6);
        font-family: 'Segoe UI', sans-serif;
    }

    .cart-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #6f42c1;
    }

    .cart-item {
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
    }

    .product-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }

    .btn-checkout {
        background-color: #6f42c1;
        color: #fff;
    }

    .btn-checkout:hover {
        background-color: #5e36a5;
    }

    .quantity-form button {
        width: 30px;
        height: 30px;
        padding: 0;
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="text-center cart-title mb-5">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <div class="row">
            <div class="col-md-8">
                @foreach($cart as $id => $item)
                    <div class="cart-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']) }}"
                                 class="product-img me-3" alt="{{ $item['name'] }}">
                            <div>
                                <h5 class="mb-1">{{ $item['name'] }}</h5>
                                <p class="mb-0 text-muted">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                <div class="d-flex align-items-center mt-2 quantity-form">
                                    <form action="{{ route('cart.decrease', $id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-secondary">−</button>
                                    </form>
                                    <span class="mx-2">{{ $item['quantity'] }}</span>
                                    <form action="{{ route('cart.increase', $id) }}" method="POST" class="me-3">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h5>Total:</h5>
                    <p class="fs-4 fw-bold text-danger">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                    <form action="{{ route('cart.checkout') }}" method="GET">
                        @csrf
                        <button class="btn btn-checkout w-100 mt-2">
                            <i class="bi bi-credit-card-fill"></i> Checkout Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Keranjang Anda kosong. <br>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-left-circle"></i> Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
