@extends('layouts.app')

@section('title', 'Checkout - The Agni Canvas')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">

<style>
    body {
        background: linear-gradient(to bottom right, #f3e5f5, #ede7f6);
        font-family: 'Segoe UI', sans-serif;
    }

    .checkout-heading {
        font-size: 2.5rem;
        font-weight: bold;
        color: #6f42c1;
    }

    .checkout-form {
        background-color: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(111, 66, 193, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: #6f42c1;
    }

    .form-control, .form-select {
        border: 2px solid #e0d7f3;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ba68c8;
        box-shadow: 0 0 0 0.2rem rgba(186, 104, 200, 0.25);
    }

    .total-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #d63384;
    }

    .btn-checkout {
        background-color: #6f42c1;
        color: #fff;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-checkout:hover {
        background-color: #5e35b1;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="text-center checkout-heading mb-4">Checkout</h2>

    <form action="{{ route('cart.processCheckout') }}" method="POST" class="checkout-form mx-auto col-md-8">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Penerima</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="">-- Pilih Metode --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="cod">Bayar di Tempat (COD)</option>
                <option value="ewallet">E-Wallet (OVO, DANA, dsb)</option>
            </select>
        </div>

        <div class="text-end my-4">
            <span class="total-price">Total: Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <button type="submit" class="btn btn-checkout w-100"><i class="bi bi-truck"></i> Konfirmasi & Pesan</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Terima kasih!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Kembali ke Dashboard',
            timer: 3500,
            timerProgressBar: true,
            willClose: () => {
                window.location.href = "{{ route('dashboard') }}";
            }
        });
    });
</script>
@endif
@endpush

