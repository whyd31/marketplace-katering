
    <!-- Hero Section -->
    <div class="hero vh-100 d-flex justify-content-center align-items-center" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto my-auto text-center">
                    @foreach ($profile->take(1) as $profil)
                        <h1 class="display-4 text-white">{{ $profil->name }}</h1>
                        <article class="text-white my-3 "> {{ Illuminate\Support\Str::limit(strip_tags($profil->content), 310) }} </article>
                    @endforeach                 
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


