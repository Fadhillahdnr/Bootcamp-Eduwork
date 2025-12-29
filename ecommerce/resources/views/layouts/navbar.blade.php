<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('beranda') }}">Toko Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}"
            href="{{ route('beranda') }}">
            Beranda
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}"
            href="{{ route('cart') }}">
            Keranjang
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
            href="{{ route('about') }}">
            Tentang Kami
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('checkout') ? 'active' : '' }}"
            href="{{ route('checkout') }}">
            Checkout
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>