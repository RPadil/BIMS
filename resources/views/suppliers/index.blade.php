@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{ route('suppliers.create')}}" class="btn btn-success float-right">Add</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Last Name</td>
          <td>Middle Name</td>
          <td>Last Name</td>
          <td>Age</td>
          <td>City</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
<div>
@endsection