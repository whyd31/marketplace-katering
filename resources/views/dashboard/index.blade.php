@extends('dashboard.layouts.main')

@section('container')
    @foreach ($profile->take(1) as $profil)
    @can('user-role', 0)
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang di <strong class="profil-name">{{ $profil->name }}</strong>, {{ auth()->user()->name }}</h1>
    </div>
    @endcan
    @can('user-role', 1)
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang di <strong class="profil-name">{{ $profil->name }}</strong>, {{ auth()->user()->name }}</h1>
    </div>
    @endcan
    @can('user-role', 2)
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang di <strong class="profil-name">{{ $profil->name }}</strong>, {{ auth()->user()->name }}</h1>
    </div>
    @endcan
    @endforeach 
@endsection