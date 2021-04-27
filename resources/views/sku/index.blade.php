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
          <th class="centered">SKU Name</th>
          <th class="centered">SKU Description</th>
          <th class="centered">Category</th>
          <th class="centered">Sub Category</th>
          <th class="centered">Parent SKU</th>
          <th class="centered">Active/Inactive</th>
          <th class="centered" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sku as $skus)
        <tr>
            <td class="centered">{{$skus->sku_name}}</td>
            <td class="centered">{{$skus->sku_desc}}</td>
            @if ($skus->cat_id)
            <td class="centered">{{$cat_array[$skus->cat_id]}}</td>
            <td class="centered">{{$subcat_array[$skus->subcat_id]}}</td>
            <td class="centered">{{$psku_array[$skus->psku_id]}}</td>
            @endif
            @if ($skus->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('sku.edit',$skus->id)}}" class="btn btn-primary">Edit</a>
              @if ($skus->is_active === 1)
              <a href="{{ route('skusdeactivate',$skus->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('skusactivate',$skus->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('skus.destroy', $skus->id)}}" class="btn btn-danger">Delete</a>
            </td>
            
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="float: right;">{{ $sku->links() }}</td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection