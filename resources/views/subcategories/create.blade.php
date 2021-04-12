@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New Sub Category</h3>
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
      <form method="post" action="{{ route('subcategories.store') }}">
          <div class="form-group">
              @csrf
              <label for="subcat_code">Sub Category Code:</label>
              <input type="text" class="form-control" name="subcat_code"/>
          </div>
          <div class="form-group">
              <label for="subcat_name">Sub Category Name:</label>
              <input type="text" class="form-control" name="subcat_name"/>
          </div>
          <div class="form-group">
              <label for="cat_name">Category Name:</label>
              <select class="form-control" name="cat_name">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $key => $value)
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection