@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Categories</h3>
    </div>
      <a href="{{ route('categories.create')}}" class="btn btn-success float-left">Add New Category</a>
  </div>
  <div class="card-body">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Category Code</td>
          <td>Category Name</td>
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
        {{ $categories->links() }}
    </tbody>
  </table>
</div>
</div>
@endsection