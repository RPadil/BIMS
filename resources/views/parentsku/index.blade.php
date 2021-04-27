@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Parent SKUs</h3>
    </div>
      <a href="{{ route('parentsku.create')}}" class="btn btn-success float-left">Add New Parent SKU </a>
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
        @foreach($parentsku as $parentskus)
        <tr>
            <td class="centered">{{$parentskus->psku_name}}</td>
            <td class="centered">{{$parentskus->psku_desc}}</td>
            @if ($parentskus->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('parentsku.edit',$parentskus->id)}}" class="btn btn-primary">Edit</a>
              @if ($parentskus->is_active === 1)
              <a href="{{ route('parentskudeactivate',$parentskus->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('parentskuactivate',$parentskus->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('parentsku.destroy', $parentskus->id)}}" class="btn btn-danger">Delete</a> 
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td style="float: left;">{{ $parentsku->links() }}</td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection