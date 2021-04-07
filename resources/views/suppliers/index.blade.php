@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{ route('suppliers.create')}}" class="btn btn-success float-right">Add</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Supplier Code</td>
          <td>Supplier Name</td>
          <td>Location</td>
          <td>Active/Inacive</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{$supplier->supp_code}}</td>
            <td>{{$supplier->supp_name}}</td>
            <td>{{$supplier->location}}</td>
            <td>{{$supplier->is_active}}</td>
            <td><a href="{{ route('supplier.edit',$supplier->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('supplier.destroy', $supplier->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        {{ $infos->links() }}
    </tbody>
  </table>
<div>
@endsection