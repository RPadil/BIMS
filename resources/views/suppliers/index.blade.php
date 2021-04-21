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
          <th>Supplier Code</th>
          <th>Supplier Name</th>
          <th>Location</th>
          <th>Contact</th>
          <th>Active/Inactive</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{$supplier->supp_code}}</td>
            <td>{{$supplier->supp_name}}</td>
            <td>{{$supplier->location}}</td>
            <td>{{$supplier->contact}}</td>
            @if ($supplier->is_active === 1)
            <td>Active</td>
            @else
            <td>Inactive</td>
            @endif
            <td><a href="{{ route('suppliers.edit',$supplier->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('suppliers.destroy', $supplier->id)}}" method="post">
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
        <td style="float: left;">{{ $suppliers->links() }}</td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection