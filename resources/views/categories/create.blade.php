@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New Category</h3>
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
      <form method="post" action="{{ route('categories.store') }}">
          <div class="form-group">
              @csrf
              <label for="supp_code">Category Code:</label>
              <input type="text" class="form-control" name="supp_code"/>
          </div>
          <div class="form-group">
              <label for="supp_name">Category Name:</label>
              <input type="text" class="form-control" name="supp_name"/>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection