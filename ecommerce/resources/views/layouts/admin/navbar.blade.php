<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('beranda') }}">Toko Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">
            Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}"
            href="{{ route('admin.orders') }}">
            Kelola Pesanan
            </a>
        </li>
      </ul>

      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
  </div>
</nav>