<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">
        <span className="fs-7 fw-bold">
          MARKETPLACE KATERING
        </span>   
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-white" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="/profil">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="/login">Masuk</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('service') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Daftar
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/register-costumer">Pelanggan</a></li>
                <li><a class="dropdown-item" href="/register-merchant">Merchant</a></li>
            </ul>
        </li>
        </ul>
      </div>
    </div>
</nav>
<!-- End Navigation Bar -->