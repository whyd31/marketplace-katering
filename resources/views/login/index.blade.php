@extends('layouts.main')

@section('container')

<div class="d-flex justify-content-center" style="margin-top: 125px">
    <div class="col-md-4">

      @if (session()->has('message'))
        <div class="alert alert-{{ session('alert-type') }} col-lg-50" role="alert" id="alert-message">
          {{ session('message') }}
        </div>
      @endif
      
      <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
          <form action="/login" method="post">
            @csrf
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
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
          </form>
          <div class="text-center mt-4 text-lg fs-6">
            <p><a class="font-bold" href="#" id="forgotPasswordLink">Lupa Password?</a>.</p>
          </div>
          <div class="text-center mt-4 text-lg fs-6">
            <p>Belum Punya Akun? <a class="font-bold" href="/register-costumer">Klik Disini</a></p>
          </div>
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



