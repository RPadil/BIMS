@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>Update Item</h3>
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
      <form method="post" action="{{ route('item.update', $items->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="item_name">Item Name:</label>
              <input type="text" class="form-control" name="item_name" value="{{ $items->item_name }}"/>
          </div>
          <div class="form-group">
              <label for="item_desc">Item Description:</label>
              <input type="text" class="form-control" name="item_desc" value="{{ $items->item_desc }}"/>
          </div>
          <div class="form-group">
              <label for="supp_name">Supplier:</label>
              <select class="form-control" name="supp_name">
                <option value="">-- Select Supplier --</option>
                @foreach ($suppliers as $supplier)
                @if ($items->supp_id === $supplier->supp_id)
                <option value="{{ $supplier->supp_id }}" selected="selected">{{ $supplier->supp_name }}</option>
                @else
                <option value="{{ $supplier->supp_id }}">{{ $supplier->supp_name }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="cat_name">Category:</label>
              <select class="form-control" name="cat_name" id="cat_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                @if ($items->cat_id === $category->cat_id)
                <option value="{{ $category->cat_id }}" selected="selected">{{ $category->cat_name }}</option>
                @else
                <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="subcat_name">Sub Category:</label>
              <select class="form-control" name="subcat_name" id="subcat_id">
                @foreach ($subcategories as $subcategory)
                @if ($items->subcat_id === $subcategory->subcat_id)
                <option value="{{ $subcategory->subcat_id }}" selected="selected">{{ $subcategory->subcat_name }}</option>
                @else
                <option value="{{ $subcategory->subcat_id }}">{{ $subcategory->subcat_name }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="sku_name">SKU:</label>
              <select class="form-control" name="sku_name" id="sku_id">
                @foreach ($skus as $sku)
                @if ($items->sku_id === $sku->sku_id)
                <option value="{{ $sku->sku_id }}" selected="selected">{{ $sku->sku_name }}</option>
                @else
                <option value="{{ $sku->sku_id }}">{{ $sku->sku_name }}</option>
                @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="qty">Quantity:</label>
              <input type="number" class="form-control" name="qty" value="{{ $items->qty }}"/>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" placeholder="₱ 00.00" class="form-control" name="price" value="{{ number_format($items->price,2) }}"/>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection