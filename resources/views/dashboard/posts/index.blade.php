@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Posts</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-responsive col-lg-10">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
    <table class="table table-light table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)    
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td>
            {{-- tombol lihat postingan --}}
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-dark text-light"><span data-feather="eye"></span></a>
            {{-- tombol edit --}}
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning text-dark rounded-pill"><span data-feather="edit"></span></a>
            {{-- tombol delete --}}
            <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
              {{-- mengganti methodnya menjadi delete --}}
              @method('DELETE') 
              @csrf
              <button class="badge bg-danger text-light border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
            </form>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

@endsection