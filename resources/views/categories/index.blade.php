@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Product Categories</h3>
    </div>
      <a href="{{ route('categories.create')}}" class="btn btn-success float-left">Add New Product Category</a>
  </div>
  <div class="card-body">
  <table class="table table-striped" border="0">
    <thead>
        <tr>
          <th class="centered">Product Category Code</th>
          <th class="centered">Product Category Name</th>
          <th class="centered">Active/Inactive</th>
          <th class="centered" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td class="centered">{{$category->cat_code}}</td>
            <td class="centered">{{$category->cat_name}}</td>
            @if ($category->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
              @if ($category->is_active === 1)
              <a href="{{ route('categoriesdeactivate',$category->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('categoriesactivate',$category->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('categories.destroy', $category->id)}}" class="btn btn-danger">Delete</a> 
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td style="float: left;">{{ $categories->links() }}</td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection