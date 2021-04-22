@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Suppliers</h3>
    </div>
      <a href="{{ route('suppliers.create')}}" class="btn btn-success float-left">Add New Supplier</a>
  </div>
  <div class="card-body">
  <table class="table table-striped" border="0">
    <thead>
        <tr>
          <th class="centered">Supplier Code</th>
          <th class="centered">Supplier Name</th>
          <th class="centered">Location</th>
          <th class="centered">Contact</th>
          <th class="centered">Active/Inactive</th>
          <th class="centered">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td class="centered">{{$supplier->supp_code}}</td>
            <td class="centered">{{$supplier->supp_name}}</td>
            <td class="centered">{{$supplier->location}}</td>
            <td class="centered">{{$supplier->contact}}</td>
            @if ($supplier->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('suppliers.edit',$supplier->id)}}" class="btn btn-primary">Edit</a> 
              @if ($supplier->is_active === 1)
              <a href="{{ route('suppliersdeactivate',$supplier->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('suppliersactivate',$supplier->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('suppliers.destroy',$supplier->id)}}" class="btn btn-danger">Delete</a> 
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="float: right;">{{ $suppliers->links() }}</td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection
