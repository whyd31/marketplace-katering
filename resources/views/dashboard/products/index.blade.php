@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Menu Makanan</h1>
</div>

@if (session()->has('message'))
    <div class="alert alert-{{ session('alert-type') }} col-lg-50" role="alert" id="alert-message">
        {{ session('message') }}
    </div>
@endif

@can('user-role', 0)  
<form action="{{ route('products.index') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-10">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau lokasi" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>
<hr>
<div class="row">
    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card">
            <h5 class="card-title fw-bold text-center mt-2 mb-2 bold">{{ $product->user->name }}</h5>
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Rp.{{ number_format($product->harga, 2) }}</p>
                <p class="card-text">Deskripsi : </p>
                <p class="card-text">{{ $product->deskripsi }}</p>
                <hr>
                <p class="card-text">{{ $product->user->alamat }}</p>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="btn btn-success text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Cart"><span data-feather="shopping-cart"></span> Pesan</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endcan

@can('user-role', 1)  
<div class="row">
        <div class="col-lg-10 mb-4">
            <a href="/dashboard/products/create" class="btn btn-primary mb-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload">Tambah Makanan</a>
        </div>

    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Rp.{{ number_format($product->harga, 2) }}</p>
                <p class="card-text">Deskripsi : </p>
                <p class="card-text">{{ $product->deskripsi }}</p>
                <div class="d-flex justify-content-between">
                    <a href="/dashboard/products/{{ $product->id }}/edit" class="btn btn-warning text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span data-feather="edit"></span> Edit</a>
                    <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="confirmDelete(this, '{{ $product->name }}')"><span data-feather="x-circle"></span> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endcan

<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alert = document.getElementById('alert-message');
        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 4000); // 4000ms = 4 seconds
        }
    });

    function confirmDelete(button, productName) {
        Swal.fire({
            title: "Hapus " + productName + " ?",
            text: "Yakin mau hapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }

    function addToCart(productId) {
        // Send AJAX request to add product to cart
        fetch(`/dashboard/products/${productId}/add-to-cart`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Update cart count in the navbar
            document.getElementById('cart-count').innerText = data.count;

            // Optional: show a success message
            Swal.fire({
                icon: 'success',
                title: 'Ditambahkan ke keranjang',
                text: 'Produk berhasil ditambahkan ke keranjang!',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

</script>

@endsection
