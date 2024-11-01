@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Menu Makanan</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/products/{{ $product->id }}" class="mb-5" enctype="multipart/form-data" onsubmit="removeFormat()">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Menu</label>
                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required autofocus value="{{ old('deskripsi', $product->deskripsi) }}">
                @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga', $product->harga) }}" oninput="formatRupiah()">
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-1">
                <label for="image" class="form-label">Update Foto</label>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-preview-edit img-fluid mb-1 col-sm-6 d-block">
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

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/dashboard/products" class="btn btn-warning">Kembali</a>
        </form>
    </div>
@endsection

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

    function formatRupiah() {
        const hargaField = document.querySelector('#harga');
        let hargaValue = hargaField.value.replace(/[^,\d]/g, '').toString();
        
        const split = hargaValue.split(',');
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        hargaField.value = 'Rp ' + rupiah;
    }

    function removeFormat() {
        const hargaField = document.querySelector('#harga');
        hargaField.value = hargaField.value.replace(/[^0-9,]/g, '').replace(',', '.');
    }
</script>

