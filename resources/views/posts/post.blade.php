
@extends('layouts.main')

@section('container')

  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8">
        <h2 class="mb-3">{{ $post->title }}</h2>

        <p>By: <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in
          <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">
            {{ $post->category->name }}
          </a>
        </p>
        {{-- kalau user menginputkan gambar, ambil dari folder post-images --}}
        @if ($post->image)
        <div style="max-height:350px; overflow:hidden;" class="text-center">
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid rounded-top">
        </div>
        @else
        {{-- kalau user tidak menginputkan gambar, ambil gambar random dari unsplash --}}
          <img src="https://source.unsplash.com/500x300?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">  
        @endif
        <article class="my-3 fs-5">
          {!! $post->body !!}
        </article>
    
        <a href="/posts" class="d-block mt-2 text-decoration-none">&larr; Back to all posts</a>
      </div>
    </div>
  </div>




   
@endsection