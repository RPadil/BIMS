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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Supplier Code</td>
          <td>Supplier Name</td>
          <td>Location</td>
          <td>Active/Inactive</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{$supplier->supp_code}}</td>
            <td>{{$supplier->supp_name}}</td>
            <td>{{$supplier->location}}</td>
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
        {{ $suppliers->links() }}
    </tbody>
  </table>
</div>
</div>
@endsection