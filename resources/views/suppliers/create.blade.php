@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New Supplier</h3>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('suppliers.store') }}">
          <div class="form-group">
              @csrf
              <label for="supp_code">Supplier Code:</label>
              <input type="text" class="form-control" name="supp_code"/>
          </div>
          <div class="form-group">
              <label for="supp_name">Supplier Name:</label>
              <input type="text" class="form-control" name="supp_name"/>
          </div>
          <div class="form-group">
              <label for="loc">Location:</label>
              <input type="text" class="form-control" name="loc"/>
          </div>
          <div class="form-group">
              <label for="contact">Contact:</label>
              <input type="text" class="form-control" name="contact"/>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection