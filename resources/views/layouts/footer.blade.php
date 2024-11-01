    <!-- Footer Section -->
    <footer class="sticky-footer" id="contact">
        <div class="footer-top">
          <div class="container-fluid px-4">
            <div class="row gy-3 d-flex justify-content-between">
              <div class="col-md-6">
                <h4 class="text-white">Contact</h4>
                @foreach ($footers->take(1) as $footer)
                  <ul class="list-unstyled">
                    <li>{{ $footer->address }}</li>
                    <li>Email : {{ $footer->email }}</li>
                    <li>Telephone : {{ $footer->telephone }}</li>
                  </ul>
                @endforeach
              </div>
              <div class="col-md-3 map">
                @foreach ($footers->take(1) as $footer)
                    {!! $footer->maps !!}
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom py-3">
          <div class="container">
            <div class="row">
              <div class="text-center">
                <small>
                  Copyright &copy; 2022 @foreach ($profile->take(1) as $profil)<span class="text-white mx-2">{{ $profil->content }} .</span> @endforeach
                  All Rights Reserved
                </small>
              </div>
            </div>
            </div>
          </div>
        </div>
    </footer>
    <!-- End Footer Section -->


    


