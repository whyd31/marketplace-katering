<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Profil;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ImageProperty;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        $userRole = auth()->user()->role; // Ambil role pengguna yang sedang login
        $products = []; // Inisialisasi array produk

        // Cek role pengguna
        if ($userRole == 0) {
            // Jika role user (0), cek apakah ada pencarian
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;

                // Mengambil produk berdasarkan nama atau alamat pengguna
                $products = Product::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('user', function($query) use ($search) {
                        $query->where('alamat', 'LIKE', '%' . $search . '%'); // Cek kolom alamat di tabel users
                    })
                    ->get();
            } else {
                // Jika tidak ada pencarian, ambil semua produk
                $products = Product::all();
            }
        } else {
            // Jika role merchant (1), ambil produk yang ditambahkan oleh merchant tersebut
            $products = Product::where('user_id', auth()->id())->get();
        }

        return view('dashboard.products.index', [
            'profile' => Profil::latest()->get(),
            'products' => $products,
            'cartCount' => $cartCount,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'profile' => Profil::latest()->get(),
            'products' => Product::all(),
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        $validatedData['harga'] = str_replace(['Rp', '.', ','], ['', '', '.'], $request->harga);
        $validatedData['user_id'] = auth()->id();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('image-product');
        }

        Product::create($validatedData);

        return redirect('/dashboard/products')->with([
            'message' => 'Berhasil Menambahkan Menu Makanan!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'profile' => Profil::latest()->get(),
            'products' => Product::all(),
            'product' => $product,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            return redirect('/dashboard/products')->with([
                'message' => 'Anda tidak memiliki izin untuk mengubah produk ini!',
                'alert-type' => 'danger'
            ]);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'harga' => 'required',
            'imageEdit' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        $validatedData['harga'] = str_replace(['Rp', '.', ','], ['', '', '.'], $request->harga);

        if($request->file('imageEdit')) {
            if($product->image){
                Storage::delete($product->image);
            }
            $validatedData['image'] = $request->file('imageEdit')->store('image-product');
        }

        $product->update($validatedData);

        return redirect('/dashboard/products')->with([
            'message' => 'Berhasil Mengubah Menu Makanan!',
            'alert-type' => 'warning'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'Menu Makanan Berhasil Di Hapus!');
    }

    public function cart()
    {
        $userId = auth()->id(); // Ambil ID pengguna yang sedang login
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return view('dashboard.products.cart', [
            'profile' => Profil::latest()->get(),
            'cartItems' => $cartItems,
            'cartCount' => $cartCount,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
        ]);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $userId = auth()->id(); // Ambil ID pengguna yang sedang login

        // Cek apakah produk sudah ada di keranjang pengguna
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan kuantitas
            $cartItem->increment('quantity');
        } else {
            // Jika belum ada, buat item keranjang baru
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        // Kembalikan jumlah total produk dalam keranjang
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');

        return response()->json(['count' => $cartCount]);
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $userId = auth()->id();
        
        // Ambil item dari keranjang pengguna saat ini
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        
        // Hitung total harga
        $totalHarga = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
        
        // Pindahkan item keranjang ke tabel riwayat_orders
        foreach ($cartItems as $item) {
            // Tambahkan ke tabel riwayat_orders (sesuaikan nama model jika berbeda)
            \DB::table('orders')->insert([
                'user_id' => $userId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->product->harga * $item->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Hapus item dari keranjang setelah checkout
        Cart::where('user_id', $userId)->delete();

        // Kembalikan ke tampilan invoice dengan SweetAlert
        return redirect('/dashboard/invoice')->with([
            'success' => 'Berhasil melakukan checkout!',
            'alert-type' => 'success'
        ]);
    }

}
