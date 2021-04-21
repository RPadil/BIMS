@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>SKUs</h3>
    </div>
      <a href="{{ route('sku.create')}}" class="btn btn-success float-left">Add New SKU</a>
  </div>
  <div class="card-body">
  <table class="table table-striped" border="0">
    <thead>
        <tr>
          <th>SKU Name</th>
          <th>SKU Description</th>
          <th>Category</th>
          <th>Sub Category</th>
          <th>Active/Inactive</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sku as $skus)
        <tr>
            <td>{{$skus->sku_name}}</td>
            <td>{{$skus->sku_desc}}</td>
            @if ($skus->cat_id)
            <td>{{$cat_array[$skus->cat_id]}}</td>
            <td>{{$subcat_array[$skus->subcat_id]}}</td>
            @endif
            @if ($skus->is_active === 1)
            <td>Active</td>
            @else
            <td>Inactive</td>
            @endif
            <td><a href="{{ route('sku.edit',$skus->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('sku.destroy', $skus->id)}}" method="post">
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
        <td></td>
        <td style="float: left;">{{ $sku->links() }}</td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection