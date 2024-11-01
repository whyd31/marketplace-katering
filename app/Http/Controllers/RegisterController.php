<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Footer;
use App\Models\Profil;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ImageProperty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function costumer(){
        return view('register.costumer', [
            "title" => 'Register',
            "includeHero" => false,
            "active" => 'register',
            'footers' => Footer::latest()->get(),
            'profile' => Profil::latest()->get(),
            'propertiez'  => ImageProperty::select('image')->where('property', 'Banner')->get(),
            'properties' => ImageProperty::where('property', 'Logo')->get(),
        ]);

    }

    public function merchant(){
        return view('register.merchant', [
            "title" => 'Register',
            "includeHero" => false,
            "active" => 'register',
            'footers' => Footer::latest()->get(),
            'profile' => Profil::latest()->get(),
            'propertiez'  => ImageProperty::select('image')->where('property', 'Banner')->get(),
            'properties' => ImageProperty::where('property', 'Logo')->get(),
        ]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:0,1,2',
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:6',
            'name' => 'required|max:255',
            'no_hp' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('image-user');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with([
            'message' => 'Berhasil Registrasi silahkan login!',
            'alert-type' => 'success'
        ]);
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'Anda harus login terlebih dahulu.');
        }
        
        $user = Auth::user();
        // Cek apakah data user tersedia
        if (!$user) {
            return redirect('/login')->with('message', 'User tidak ditemukan.');
        }
        
        $userId = auth()->id();
        $cartItems = Order::with('product')->where('user_id', $userId)->get();
        $cartCount = Order::where('user_id', auth()->id())->sum('quantity');
        
        return view('dashboard.profiles.index', [
            'profile' => Profil::latest()->get(),
            'cartItems' => $cartItems,
            'cartCount' => $cartCount,
            'user' => $user,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get() // Mengirim data user ke tampilan
        ]);
    }

    public function edit()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'Anda harus login terlebih dahulu.');
        }
        
        $user = Auth::user();
        // Cek apakah data user tersedia
        if (!$user) {
            return redirect('/login')->with('message', 'User tidak ditemukan.');
        }
        
        $userId = auth()->id();
        $cartItems = Order::with('product')->where('user_id', $userId)->get();
        $cartCount = Order::where('user_id', auth()->id())->sum('quantity');
        
        return view('dashboard.profiles.edit', [
            'profile' => Profil::latest()->get(),
            'cartItems' => $cartItems,
            'cartCount' => $cartCount,
            'user' => $user,
            'properties' => ImageProperty::where('property', 'Logo')->latest()->get() // Mengirim data user ke tampilan
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required',
            'alamat' => 'required',
            'imageEdit' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        // Update foto jika ada
        if ($request->file('imageEdit')) {
            // Hapus foto lama jika ada
            if ($user->image) {
                Storage::delete($user->image);
            }
            $validatedData['image'] = $request->file('imageEdit')->store('image-user');
        }

        // Hanya hash password jika ada input baru
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Hapus password jika tidak ada input
        }

        // Update data pengguna
        $user->update($validatedData);

        return redirect('/dashboard/profiles')->with([
            'message' => 'Profil berhasil diperbarui!',
            'alert-type' => 'warning'
        ]);
    }

}
