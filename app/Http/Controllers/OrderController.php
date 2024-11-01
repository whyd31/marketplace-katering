<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Profil;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ImageProperty;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Ambil ID pengguna yang sedang login
        $userRole = auth()->user()->role; // Pastikan Anda memiliki atribut 'role' di model User

        // Mendapatkan cartItems pengguna yang sedang login
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // Mengambil pesanan berdasarkan role
        if ($userRole == 0) {
            // Jika role user (0), ambil semua pesanan yang dibuat oleh user ini
            $orders = Order::with('product')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        } else {
            // Jika role merchant (1), ambil pesanan yang terkait dengan produk yang ditambahkan oleh merchant ini
            $orders = Order::with('product')->whereHas('product', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->orderBy('created_at', 'desc')->get();
        }

        // Mengelompokkan pesanan berdasarkan tanggal
        $groupedOrders = $orders->groupBy(function($order) {
            return $order->created_at->format('d M Y'); // Format tanggal yang diinginkan
        });

        // Menghitung total harga dari cartItems
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');
        $totalHarga = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        
        return view('dashboard.invoice', [
            'profile' => Profil::latest()->get(),
            'cartItems' => $cartItems,
            'cartCount' => $cartCount,
            'totalHarga' => $totalHarga,
            'groupedOrders' => $groupedOrders,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
        ]);
    }

}
