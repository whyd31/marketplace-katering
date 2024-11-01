<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @foreach ($properties->take(1) as $property)
      <link rel="icon" href="{{ asset('storage/' . $property->image) }}">
    @endforeach   

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Core CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script nonce="{{ csp_nonce() }}" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <style> 
      .hero {
        @foreach ($propertiez->take(1) as $property)
          background-image: url('{{ asset('storage/' . $property->image) }}');
        @endforeach
      }
      .pdfobject-container { 
        height: 100vh;
        border: 1rem solid rgba(0,0,0,.1);
      }
    </style>
    @foreach ($profile->take(1) as $profil)
      <title>{{ $profil->name }}</title>
    @endforeach
    

  </head>
  <body>
    @include('layouts.navbar')
    
    @includeWhen($includeHero, 'layouts.hero')

    
    <div class="m-0 p-0">
      @yield('container')
    </div>

    @include('layouts.footer')


    
    <!-- Bootstrap Bundle with Popper -->
    <script nonce="{{ csp_nonce() }}" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" nonce="{{ csp_nonce() }}"></script>
    
    <script nonce="{{ csp_nonce() }}" type="text/javascript">
      var nav=document.querySelector('nav');

      window.addEventListener('scroll', function(){
          if(window.pageYOffset > 30){
              nav.classList.add('bg-dark', 'shadow', 'navbar-dark');
          } else {
              nav.classList.remove('bg-dark', 'shadow', 'navbar-dark')
          }
      })

      $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '/login/reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
      });

      function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
      }

      document.querySelectorAll(".pesanLink").forEach(function(element) {
        element.addEventListener("click", function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Ingin Pesan?',
                text: 'Silahkan login terlebih dahulu!!!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        });
      });
    </script>
  </body>
</html>
