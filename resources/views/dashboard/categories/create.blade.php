@extends('dashboard.layouts.main')


@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add new category</h1>
  </div>  

  <div class="col-lg-8">
    <form method="POST" action="/dashboard/categories">
      @csrf
      <div class="mb-3">
        <label for="category" class="form-label">Add Category</label>
        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" autofocus>
        <div id="emailHelp" class="form-text">Silahkan masukan category</div>
        @error('category')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
  </div>

@endsection