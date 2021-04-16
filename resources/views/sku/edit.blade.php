@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>Update SKU</h3>
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
      <form method="post" action="{{ route('sku.update', $sku->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="sku_name">SKU Name:</label>
              <input type="text" class="form-control" name="sku_name" value="{{ $sku->sku_name }}" />
          </div>
          <div class="form-group">
              <label for="sku_desc">SKU Description:</label>
              <input type="text" class="form-control" name="sku_desc" value="{{ $sku->sku_desc }}" />
          </div>
          <div class="form-group">
              <label for="cat_name">Category:</label>
              <select class="form-control" name="cat_name" id="cat_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $value)
                @if ($sku->cat_id === $value->cat_id)
                <option value="{{ $value->cat_id }}" selected="selected">{{ $value->cat_name }}</option>
                @else
                <option value="{{ $value->cat_id }}">{{ $value->cat_name }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="cat_name">Sub Category:</label>
              <select class="form-control" name="subcat_name" id="subcat_id">
                <option value="">-- Select Sub Category --</option>
                @foreach ($subcategories as $value)
                @if ($sku->subcat_id === $value->subcat_id)
                <option value="{{ $value->subcat_id }}" selected="selected">{{ $value->subcat_name }}</option>
                @else
                <option value="{{ $value->subcat_id }}">{{ $value->subcat_name }}</option>
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