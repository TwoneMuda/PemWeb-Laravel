@extends('layouts.app')

@section('title', $news->title)

@section('content')
  <div class="container mt-5 pt-5">
      
      {{-- Tombol Kembali (Link ke route landing) --}}
      <a href="{{ route('landing') }}" class="btn btn-outline-secondary mb-3 text-decoration-none">
          &larr; Kembali
      </a>

      <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

              {{-- JUDUL --}}
              <h1 class="fw-bold mb-4">{{ $news->title }}</h1>

              {{-- GAMBAR ARTIKEL --}}
              <div class="position-relative mb-3">
                  <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                       class="img-fluid rounded-3 w-100" 
                       alt="{{ $news->title }}">
                  
                  {{-- KATEGORI --}}
                  <span class="badge bg-dark position-absolute top-0 end-0 m-3 px-3 py-2 fs-6">
                      {{ $news->newsCategory->title ?? 'Umum' }}
                  </span>
              </div>

              {{-- INFO ARTIKEL --}}
              <div class="d-flex align-items-center text-muted small mb-4 flex-wrap">
                 <p class="text-muted mb-4">
                    <span class="fw-bold">{{ $news->author->name }}</span> - 
                    {{ $news->created_at->format('d F Y') }}
                 </p>
              </div>

              {{-- ISI ARTIKEL --}}
              {{-- PENTING: Gunakan {!! !!} karena data dari RichEditor adalah HTML --}}
              <article class="text-secondary lh-lg">
                  {!! $news->content !!}
              </article>

            </div>
        </div>
    </div>
      
  </div>
@endsection
