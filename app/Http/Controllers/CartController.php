<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('cart', compact('cart', 'total'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        // ✅ Redirect langsung ke halaman keranjang + pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Jumlah produk ditambah.');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Jumlah produk dikurangi.');
    }

    public function checkout()
    {
        session()->forget('cart');
        return redirect()->route('dashboard')->with('success', 'Checkout berhasil. Terima kasih sudah berbelanja!');
    }

    public function showCheckoutForm()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Simpan pesanan (contoh sederhana, belum ke database)
        session()->forget('cart');

        return redirect()->route('cart.checkout')->with('success', 'Pesanan Anda berhasil diproses!');
    }

    public function storeSampleProducts()
    {
        if (Product::count() > 0) {
            return redirect()->route('dashboard')->with('info', 'Produk sudah tersedia.');
        }

        $products = [
            [
                'name' => 'Cat Air Sakura',
                'description' => 'Cat air premium untuk hasil lukisan tajam dan tahan lama.',
                'price' => 45000,
                'image' => 'https://cdn.pixabay.com/photo/2017/03/26/22/16/watercolor-2175063_1280.jpg',
            ],
            [
                'name' => 'Kuas Lukis Set Lengkap',
                'description' => 'Set kuas lukis berbagai ukuran dan bentuk.',
                'price' => 60000,
                'image' => 'https://cdn.pixabay.com/photo/2016/03/27/21/36/paintbrush-1283824_1280.jpg',
            ],
            [
                'name' => 'Palet Cat Plastik',
                'description' => 'Palet tahan air untuk mencampur cat.',
                'price' => 15000,
                'image' => 'https://cdn.pixabay.com/photo/2016/04/13/21/36/palette-1323848_1280.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        return redirect()->route('dashboard')->with('success', 'Produk berhasil dimasukkan ke database.');
    }
}
