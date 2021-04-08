@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<!-- Edit -->
<div class="card uper">
  <div class="card-header">
    Edit
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
      <form method="post" action="{{ route('info.update', $info->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">First Name:</label>
          <input type="text" class="form-control" name="firstname" value={{ $info->firstname }} />
        </div>
        <div class="form-group">
          <label for="price">Middle Name:</label>
          <input type="text" class="form-control" name="middlename" value={{ $info->middlename }} />
        </div>
        <div class="form-group">
          <label for="quantity">Last Name:</label>
          <input type="text" class="form-control" name="lastname" value={{ $info->lastname }} />
        </div>
        <div class="form-group">
          <label for="quantity">Age:</label>
          <input type="text" class="form-control" name="age" value={{ $info->age }} />
        </div>
        <div class="form-group">
          <label for="quantity">City:</label>
          <input type="text" class="form-control" name="city" value={{ $info->city }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection