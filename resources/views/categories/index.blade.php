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
          <td>Product Category Code</td>
          <td>Product Category Name</td>
          <td>Active/Inactive</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{$category->cat_code}}</td>
            <td>{{$category->cat_name}}</td>
            @if ($category->is_active === 1)
            <td>Active</td>
            @else
            <td>Inactive</td>
            @endif
            <td><a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td style="float: right;">{{ $categories->links() }}</td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection