

@extends('layouts.main')

@section('container')
  <h1 class="mb-3 text-center">{{ $title }}</h1>

  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <form action="/posts">
        {{-- kalau didalam req ada category --}}
        @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        {{-- kalau didalam req ada author --}}
        @if (request('author'))
          <input type="hidden" name="author" value="{{ request('author') }}">
        @endif
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" autofocus autocomplete="off" value="{{ request('search') }}">
          <button class="btn btn-dark" type="submit">Search</button>
        </div>
      </form>
    </div>
  </div>

  {{-- untuk card besar --}}
  {{-- menghitung ada berapa jumlah postingan --}}
  @if ($posts->count() > 0)   
      <div class="card mb-5 border-0 border-bottom">
        {{-- kalau user menginputkan gambar, ambil dari folder post-images --}}
        @if ($posts[0]->image)
        <div style="max-height:350px; overflow:hidden;" class="text-center">
          <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid rounded">    
        </div>
        @else
        {{-- kalau user tidak menginputkan gambar, ambil gambar random dari unsplash --}}
          <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
        @endif

        <div class="card-body text-center">
          <h3 class="card-title">
            <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
          </h3>
          
          <p>
            <small class="text-muted">By: <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in
              <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">
                {{ $posts[0]->category->name }}
              </a> Uploaded {{ $posts[0]->created_at->diffForHumans() }}
            </small>
          </p>

          <p class="card-text">{{ $posts[0]->excerpt }}</p>

          <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
        </div>
      </div>
    {{-- end --}}

    {{-- untuk card kecil --}}
    {{-- looping semua posts nya kecuali yang pertama --}}
    <div class="container">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="position-absolute p-2 text-white" style="background-color: rgba(0,0,0,0.6)">
                <a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none">
                  {{ $post->category->name }}
                </a>
              </div>
              {{-- kalau user menginputkan gambar, ambil dari folder post-images --}}
              @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid rounded-top">
              @else
              {{-- kalau user tidak menginputkan gambar, ambil gambar random dari unsplash --}}
                <img src="https://source.unsplash.com/500x300?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">  
              @endif
              <div class="card-body">
                <a href="/posts/{{ $post->slug }}" class="card-title text-decoration-none text-dark h5">{{ $post->title }}</a>
                <p>
                  <small class="text-muted">By: <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
                    {{ $post->created_at->diffForHumans() }}
                  </small>
                </p>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    @else
    <p class="text-center fs-4">No post found.</p>
  @endif

  <div class="d-flex justify-content-end mb-3">
    {{ $posts->links() }}
  </div>

@endsection