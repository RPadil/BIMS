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
          <td>Product Sub-Category Code</td>
          <td>Product Sub-Category Name</td>
          <td>Product Category</td>
          <td>Active/Inactive</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($subcategories as $subcategory)
        <tr>
            <td>{{$subcategory->subcat_code}}</td>
            <td>{{$subcategory->subcat_name}}</td>
            <td>{{$cat_array[$subcategory->cat_id]}}</td>
            @if ($subcategory->is_active === 1)
            <td>Active</td>
            @else
            <td>Inactive</td>
            @endif
            <td><a href="{{ route('subcategories.edit',$subcategory->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('subcategories.destroy', $subcategory->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
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