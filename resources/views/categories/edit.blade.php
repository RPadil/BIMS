@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>Update Category</h3>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('categories.update', $categories->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="cat_code">Category Code:</label>
              <input type="text" class="form-control" name="cat_code" value="{{ $categories->cat_code }}">
          </div>
          <div class="form-group">
              <label for="cat_name">Category Name:</label>
              <input type="text" class="form-control" name="cat_name" value="{{ $categories->cat_name }}">
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection
