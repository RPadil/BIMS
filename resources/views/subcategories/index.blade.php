@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Product Sub-Categories</h3>
    </div>
      <a href="{{ route('subcategories.create')}}" class="btn btn-success float-left">Add New Product Sub-Category</a>
  </div>
  <div class="card-body">
  <table class="table table-striped" border="0">
    <thead>
        <tr>
          <th class="centered">Product Sub-Category Code</th>
          <th class="centered">Product Sub-Category Name</th>
          <th class="centered">Product Category</th>
          <th class="centered">Active/Inactive</th>
          <th class="centered" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subcategories as $subcategory)
        <tr>
            <td class="centered">{{$subcategory->subcat_code}}</td>
            <td class="centered">{{$subcategory->subcat_name}}</td>
            <td class="centered">{{$cat_array[$subcategory->cat_id]}}</td>
            @if ($subcategory->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('subcategories.edit',$subcategory->id)}}" class="btn btn-primary">Edit</a>
              @if ($subcategory->is_active === 1)
              <a href="{{ route('subcategoriesdeactivate',$subcategory->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('subcategoriesactivate',$subcategory->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('subcategories.destroy', $subcategory->id)}}" class="btn btn-danger">Delete</a> 
            </td>
        </tr>
        @endforeach
      <tr>
      <td></td>
      <td></td>
      <td style="float: left;">{{ $subcategories->links() }}</td>
      <td></td>
      <td></td>
      <td></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
@endsection