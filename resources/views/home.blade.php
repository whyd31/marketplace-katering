@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="col-md-8 mx-auto text-center">
        <h1>Menu Terkait</h1>
    </div>
</div>

@if (session()->has('message'))
    <div class="alert alert-{{ session('alert-type') }} col-lg-50" role="alert" id="alert-message">
        {{ session('message') }}
    </div>
@endif
  
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
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-success text-decoration-none pesanLink" data-bs-toggle="tooltip" data-bs-placement="top" title="Cart"><span data-feather="shopping-cart"></span> Pesan</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection