<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark border-bottom shadow-sm">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand fw-bold text-warning" href="#">NesaNews</a>

    <!-- Toggle Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarContent">

      <!-- Menu Categories -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
        <li class="nav-item">
          <a class="nav-link " href="/">Home</a>
        </li>

        @foreach (App\Models\NewsCategory::all() as $category)
          <li class="nav-item">
            <a class="nav-link" href="{{ Route('news.category', $category->slug) }}" class="hover:text-primary">{{ $category->title }}</a>
          </li>
        @endforeach
      </ul>

      <!-- Search -->
      <form action="{{ route('news.index') }}" method="get" class="d-flex me-3" >
        <input name="search" class="form-control me-2" type="text" id="inputCari" placeholder="Cari berita...">
        {{-- <button class="btn btn-outline-warning" type="button" onclick="cariBerita()">Cari</button> --}}
      </form>

      <!-- Login -->
      <a href="./login page/login.html" class="btn btn-secondary">Login</a>

    </div>
  </div>
</nav>

<!-- Spacer agar konten tidak ketutup navbar -->
<div style="height: 80px;"></div>
