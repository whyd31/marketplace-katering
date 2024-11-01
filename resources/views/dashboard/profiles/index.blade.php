@extends('dashboard.layouts.main')

@section('container')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if (session()->has('message'))
                <div class="alert alert-{{ session('alert-type') }} col-lg-50" role="alert" id="alert-message">
                    {{ session('message') }}
                </div>
            @endif
            
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="mb-0">Profil</h5>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="form-group mb-3">
                                <label class="form-label">Foto</label>
                                <img src="{{ asset('storage/' . $user->image) }}" class="img-preview-edit img-fluid mb-3 col-sm-12 d-block" style="width: 200px; height: 200px;">
                            </div>  
                        </div>
        
                        <div class="col-md-8">
                            @php
                                $fields = [
                                    'Nama' => $user->name,
                                    'Email' => $user->email,
                                    'No Handphone' => $user->no_hp,
                                    'Alamat' => $user->alamat,
                                ];
                            @endphp
        
                            @foreach ($fields as $label => $value)
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ $label }}</label>
                                    <input class="form-control" readonly value="{{ old(strtolower(str_replace(' ', '_', $label)), $value) }}">
                                </div>
                            @endforeach
                        </div> 
                    </div>
                </div>

                <div class="card-footer text-md-end">
                    <a href="/dashboard/profiles/{{ $user->id }}/edit" class="btn btn-primary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span data-feather="edit"></span> Edit</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('alert-message');
            if (alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 4000); // 4000ms = 4 seconds
            }
        });
    </script>
@endsection