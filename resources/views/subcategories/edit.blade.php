@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>Update Product Sub-Category</h3>
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
      <form method="post" action="{{ route('subcategories.update', $subcategories->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              @csrf
              <label for="subcat_code">Product Sub-Category Code:</label>
              <input type="text" class="form-control" name="subcat_code" value="{{ $subcategories->subcat_code }}"/>
          </div>
          <div class="form-group">
              <label for="subcat_name">Product Sub-Category Name:</label>
              <input type="text" class="form-control" name="subcat_name" value="{{ $subcategories->subcat_name }}"/>
          </div>
          <div class="form-group">
              <label for="cat_name">Category Name:</label>
              <select class="form-control" name="cat_name">
                <option value="">-- Select Category --</option>
                @foreach ($cat_array as $key => $value)
                @if($key == $subcategories->cat_id)
                <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                @else
                <option value="{{ $key }}">{{ $value }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection