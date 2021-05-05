@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New Parent SKU</h3>
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
      <form method="post" action="{{ route('parentsku.store') }}">
          <div class="form-group">
              @csrf
              <label for="psku_name">Parent SKU Name:</label>
              <input type="text" class="form-control" name="psku_name"/>
          </div>
          <div class="form-group">
              <label for="psku_desc">Parent SKU Description:</label>
              <input type="text" class="form-control" name="psku_desc"/>
          </div>
          <div class="form-group">
              <label for="cat_name">Category:</label>
              <select class="form-control" name="cat_name" id="cat_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $value)
                <option value="{{ $value->cat_id }}">{{ $value->cat_name }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="subcat_name">Sub Category:</label>
              <select class="form-control" name="subcat_name" id="subcat_id">
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