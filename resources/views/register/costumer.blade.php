@extends('layouts.main')

@section('container')

<div class="d-flex justify-content-center" style="margin-top: 125px">
    <div class="col-md-4">
      <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal text-center">Register - Pelanggan</h1>
          <form action="/register" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="role" value="0">
            <div class="mb-3">
              <div class="row">
                <div class="form-group">
                    <label for="image" class="form-label">Pilih Foto Profil</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()" required>
                    @error('image')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              </div>
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="email" class="form-control rounded @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
              <label for="email">Email</label>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div> 
              @enderror
            </div>
            <div class="form-floating mb-3" >
              <input type="password" name="password" class="form-control rounded" autocomplete="off" id="password" placeholder="Password" required>
              <label for="password">Password</label>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-check m-0">
              <input class="form-check-input" type="checkbox" value="" id="checkPassword">
              <label class="form-check-label" for="flexCheckDefault">
                Show Password
              </label>
            </div>
            <br>
            <div class="form-floating mb-3" >
              <input type="text" name="name" class="form-control rounded" autocomplete="off" id="name" placeholder="Name" required>
              <label for="name">Nama Perusahaan</label>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating mb-3" >
              <input type="text" name="alamat" class="form-control rounded" autocomplete="off" id="alamat" placeholder="Alamat" required>
              <label for="alamat">Alamat</label>
              @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating mb-3" >
              <input type="number" name="no_hp" class="form-control rounded" autocomplete="off" id="no_hp" placeholder="Kontak" required>
              <label for="no_hp">Kontak</label>
              @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar</button>
          </form>
          <div class="text-center mt-4 text-lg fs-6">
            <p>Sudah Punya Akun? <a class="font-bold" href="/login">Klik Disini</a></p>
          </div>
          <div class="text-center mt-4 text-lg fs-6">
            <p>Mau Bikin Merchant Katering? <a class="font-bold" href="/register-merchant">Klik Disini</a></p>
          </div>
          <br>
          <br>
          <br>
      </main>
  </div>
</div>

<script nonce="{{ csp_nonce() }}" type="text/javascript">
const y = document.getElementById("checkPassword");
  y.addEventListener("click", myFunction);

  function myFunction() {
    const x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>
@endsection



