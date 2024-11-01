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
                    <h5 class="mb-0">Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="/dashboard/profiles/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Update Foto</label>
                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" class="img-preview-edit img-fluid mb-1 col-sm-6 d-block" style="width: 200px; height: 200px;">
                            @else     
                                <img class="img-preview-edit img-fluid mb-1 col-sm-6">
                            @endif
                        </div>
                        <div class="mb-3">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="imageEdit" name="imageEdit" onchange="previewImageEdit()">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/dashboard/profiles" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(){
          const image = document.querySelector('#image');
          const imgPreview = document.querySelector('.img-preview');
    
          imgPreview.style.display = 'block';
    
          const blob = URL.createObjectURL(image.files[0]);
          imgPreview.src = blob;
        }
    
        function previewImageEdit(){
            const image = document.querySelector('#imageEdit');
            const imgPreview = document.querySelector('.img-preview-edit');
    
            imgPreview.style.display = 'block';
    
            const blob = URL.createObjectURL(image.files[0]);
            imgPreview.src = blob;
        }
    </script>
@endsection
