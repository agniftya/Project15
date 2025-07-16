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

@if(session('invoice'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        title: '<span style="color:#6f42c1">Invoice Pesanan</span>',
        html: `
            <div style="font-family: 'Segoe UI', sans-serif; max-width: 500px;">
                <!-- Header -->
                <div style="background: linear-gradient(to right, #6f42c1, #9c27b0); 
                            color: white; padding: 15px; border-radius: 8px 8px 0 0;
                            margin-bottom: 20px;">
                    <h3 style="margin:0; font-weight:600;">The Agni Canvas</h3>
                    <p style="margin:5px 0 0; opacity:0.9;">Thank you for your order!</p>
                </div>
                
                <!-- Invoice Details -->
                <div style="border: 1px solid #e0d7f3; border-radius: 8px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="font-weight:600; color:#6f42c1;">Nomor Pesanan:</span>
                        <span>${@json(session('invoice')['order_number'] ?? 'N/A')}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="font-weight:600; color:#6f42c1;">Tanggal:</span>
                        <span>${@json(session('invoice')['order_date'] ?? 'N/A')}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="font-weight:600; color:#6f42c1;">Status:</span>
                        <span style="background: #f3e5f5; color: #6f42c1; padding: 2px 8px; 
                              border-radius: 12px; font-size: 0.85rem;">
                            ${@json(session('invoice')['status'] ?? 'N/A')}
                        </span>
                    </div>
                    
                    <hr style="border-top: 1px dashed #e0d7f3; margin: 15px 0;">
                    
                    <div style="margin-bottom: 15px;">
                        <h4 style="color:#6f42c1; margin-bottom:10px;">Detail Pelanggan</h4>
                        <p style="margin:5px 0;"><b>Nama:</b> ${@json(session('invoice')['customer_name'] ?? 'N/A')}</p>
                        <p style="margin:5px 0;"><b>Alamat:</b> ${@json(session('invoice')['shipping_address'] ?? 'N/A')}</p>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <h4 style="color:#6f42c1; margin-bottom:10px;">Pembayaran</h4>
                        <p style="margin:5px 0;"><b>Metode:</b> ${@json(session('invoice')['payment_method'] ?? 'N/A')}</p>
                        <p style="margin:5px 0;"><b>Total:</b> <span style="font-size:1.2rem; color:#d63384; font-weight:600;">
                            Rp${new Intl.NumberFormat('id-ID').format(@json(session('invoice')['total_amount'] ?? 0))}
                        </span></p>
                    </div>
                    
                    <hr style="border-top: 1px dashed #e0d7f3; margin: 15px 0;">
                    
                    <p style="text-align:center; color:#888; font-size:0.9rem;">
                        Terima kasih telah berbelanja di The Agni Canvas
                    </p>
                </div>
            </div>
        `,
        icon: 'success',
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#6f42c1',
        width: '600px',
        padding: '20px',
        backdrop: `
            rgba(111,66,193,0.4)
            url("/images/confetti.gif")
            center top
            no-repeat
        `,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
});
</script>
@endif

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
