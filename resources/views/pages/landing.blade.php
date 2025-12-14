@extends('layouts.app')

@section('title', 'NesaNews | Berita Terbaru dan Terpercaya')

@section('content')
  <!-- Daftar Berita -->
  <div id="halamanUtama" class="flex-grow-1 container mt-5 pt-5">
      <h2 class="category-title mb-4">Berita Terbaru</h2>
      
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="daftarBerita">
        
        {{-- LOOPING DATA DARI CONTROLLER --}}
        @foreach ($news as $item)
              <div class="col">
                <div class="card h-100 shadow-sm">
                    {{-- GAMBAR --}}
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                         class="card-img-top news-img" 
                         alt="{{ $item->slug }}"
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        {{-- KATEGORI --}}
                        <span class="badge bg-dark mb-2">
                            {{ $item->newsCategory->title }}
                        </span>
                        
                        {{-- JUDUL --}}
                        <h5 class="card-title">{{ $item->title }}</h5>
                        
                        {{-- ISI BERITA (Excerpt) --}}
                        {{-- strip_tags dipakai untuk membuang tag <p><b> dari RichEditor --}}
                        <p class="card-text">
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        
                        {{-- TOMBOL BACA --}}
                        {{-- Ganti '#' dengan route detail berita kamu nanti --}}
                        <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-outline-secondary">Baca Selengkapnya</a>
                    </div>
                    
                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            {{-- PENULIS & TANGGAL --}}
                            {{ $item->author->name }} - {{ $item->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach

      </div>
  </div>
@endsection