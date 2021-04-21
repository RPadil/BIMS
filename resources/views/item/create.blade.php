@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New Item</h3>
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
      <form method="post" action="{{ route('item.store') }}">
        @csrf
          <div class="form-group">
              <label for="item_name">Item Name:</label>
              <input type="text" class="form-control" name="item_name"/>
          </div>
          <div class="form-group">
              <label for="item_desc">Item Description:</label>
              <input type="text" class="form-control" name="item_desc"/>
          </div>
          <div class="form-group">
              <label for="supp_name">Supplier:</label>
              <select class="form-control" name="supp_name">
                <option value="">-- Select Supplier --</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->supp_id }}">{{ $supplier->supp_name }}</option>
                @endforeach
              </select>
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
          <div class="form-group">
              <label for="sku_name">SKU:</label>
              <select class="form-control" name="sku_name" id="sku_id">
              </select>
          </div>
          <div class="form-group">
              <label for="qty">Quantity:</label>
              <input type="number" class="form-control" name="qty"/>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" placeholder="₱ 00.00" class="form-control" name="price"/>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection