@extends('dashboard.layouts.main')

@section('container')
<div class="container">
  <div class="row my-4">
    <div class="col-lg-8">
      <h2 class="mb-3">{{ $post->title }}</h2>

      {{-- tombol back to post --}}
      <a href="/dashboard/posts" class="btn btn-outline-dark"><span data-feather="arrow-left"></span> Back to all my posts</a>
      {{-- tombol edit --}}
      <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-outline-warning mx-1"><span data-feather="edit"></span> Edit</a>
      {{-- tombol delete --}}
      <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
        {{-- mengganti methodnya menjadi delete --}}
        @method('DELETE') 
        @csrf
        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
      </form>

      {{-- kalau user menginputkan gambar, ambil dari folder post-images --}}
      @if ($post->image)
        <div style="max-height:350px; overflow:hidden;">
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid rounded mt-3">    
        </div>
      @else
      {{-- kalau user tidak menginputkan gambar, ambil gambar random dari unsplash --}}
        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid rounded mt-3">    
      @endif


      
      <article class="my-3 fs-5">
        {!! $post->body !!}
      </article>
    </div>
  </div>
</div>
@endsection