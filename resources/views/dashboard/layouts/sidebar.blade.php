<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        @if (Auth::user()->role == 0 || Auth::user()->role == 1)
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
              <span data-feather="menu"></span>
              Menu Makanan
            </a>
          </li>
        </ul>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/invoice*') ? 'active' : '' }}" href="/dashboard/invoice">
              <span data-feather="shopping-bag"></span>
              Riwayat Order
            </a>
          </li>
        </ul>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/profiles*') ? 'active' : '' }}" href="/dashboard/profiles">
              <span data-feather="user"></span>
              Profil
            </a>
          </li>
        </ul>
        @endif

      @can('user-role', 2)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/footers*') ? 'active' : '' }}" href="/dashboard/footers">
              <span data-feather="book"></span>
              Web Footer
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/properties*') ? 'active' : '' }}" href="/dashboard/properties">
              <span data-feather="image"></span>
              Web Image
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/profils*') ? 'active' : '' }}" href="/dashboard/profils">
              <span data-feather="clipboard"></span>
              Web Profile
            </a>
          </li>
          @endcan
        </ul>
    </div>
</nav>