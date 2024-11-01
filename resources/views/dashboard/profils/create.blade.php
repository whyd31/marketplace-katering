@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create a New Profil</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/profils" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
  
              <div class="mb-3">
                  <label for="link" class="form-label">Copyright</label>
                  <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" required autofocus value="{{ old('link') }}">
                  @error('link')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
  
              <div class="mb-3">
                  <label for="content" class="form-label">Pemilik</label>
                  <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" required autofocus value="{{ old('content') }}">
                  @error('content')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <button type="submit" class="btn btn-primary">Create Web Profil</button>
              <a href="/dashboard/profils" class="btn btn-warning">Kembali</a>
        </form>
    </div>

    <script nonce="{{ csp_nonce() }}">
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection


