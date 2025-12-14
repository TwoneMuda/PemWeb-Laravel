<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <title>@yield('title')</title>
  </head>

  <body class="d-flex flex-column min-vh-100">
  
      <!-- Navbar -->
      <div>
          <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark border-bottom">
          <div class="container d-flex justify-content-between align-items-center">
              <a class="navbar-brand text-warning ">NesaNews</a>

                <ul class="nav nav-pills m-3 " id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="pill" type="button" role="tab" onclick="tampilkanBerita('utama')">Home</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" type="button" role="tab" onclick="tampilkanBerita('teknologi')">Teknologi</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" type="button" role="tab" onclick="tampilkanBerita('olahraga')">Olahraga</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" type="button" role="tab" onclick="tampilkanBerita('hiburan')">Hiburan</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" type="button" role="tab" onclick="tampilkanBerita('politik')">Politik</button>
                  </li>
                </ul>

                <div class=" d-flex" role="search">
                    <input class="form-control me-2" type="text" id="inputCari" placeholder="Cari berita..."/>
                    <button class="btn btn-outline-warning" type="button" onclick="cariBerita()">Cari</button>
                </div>

                <a href="./login page/login.html">
                  <button class="btn btn-secondary">Login</button>
                </a>
          </div>
          </nav>            
      </div>

     
      <!-- Daftar Berita -->
      <div id="halamanUtama" class="flex-grow-1 container mt-5 pt-5">
          <h2 class="category-title" id="judulKategori"></h2>
          <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 " id="daftarBerita"></div>
        </div>

      <!-- Halaman Berita -->  
      <div id="halamanDetail" class="container mt-5 pt-5">
        <button class="btn btn-outline-secondary mb-3" onclick="kembali()">&larr; Kembali</button>
        <div id="detailBerita"></div>

      <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-lg-9">

          <!-- Judul -->
          <h1 id="judulBerita" class="fw-bold mb-4">
          </h1>

          <!-- Gambar Artikel -->
          <div class="position-relative mb-3">
            <img id="gambarBerita" src="" class="img-fluid rounded-3 w-100" alt="Gambar Artikel">
            <span id="kategoriBerita" class="badge bg-dark position-absolute top-0 end-0 m-3 px-3 py-2 fs-6"></span>
          </div>

          <!-- Info Artikel -->
          <div class="d-flex align-items-center text-muted small mb-4 flex-wrap">
             <p id="" class="text-muted mb-4"><span id="penulisBerita"></span> - <span id="tanggalBerita"></span></p>
          </div>

          <!-- Isi Artikel -->
          <p id="isiBerita" class="text-secondary lh-lg"></p>

        </div>
      </div>
    </div>
      
      </div>
      




      <!-- Footer -->
      <footer class="bg-dark text-center py-3 mt-auto">
        
              <h5 class="text-warning me-auto ms-auto">NesaNews</h5>
            
      </footer>


    <script src="berita.js"></script>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>