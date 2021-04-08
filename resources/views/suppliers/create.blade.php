@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add
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
      <form method="post" action="{{ route('info.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">First Name:</label>
              <input type="text" class="form-control" name="firstname"/>
          </div>
          <div class="form-group">
              <label for="price">Middle Name:</label>
              <input type="text" class="form-control" name="middlename"/>
          </div>
          <div class="form-group">
              <label for="quantity">Last Name:</label>
              <input type="text" class="form-control" name="lastname"/>
          </div>
          <div class="form-group">
              <label for="quantity">Age:</label>
              <input type="text" class="form-control" name="age"/>
          </div>
          <div class="form-group">
              <label for="quantity">City:</label>
              <input type="text" class="form-control" name="city"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection