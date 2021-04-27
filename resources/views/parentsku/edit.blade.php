@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>Update Parent SKU</h3>
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
      <form method="post" action="{{ route('parentsku.update', $psku->psku_id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="psku_name">Parent SKU Name:</label>
              <input type="text" class="form-control" name="psku_name" value="{{ $psku->psku_name }}">
          </div>
          <div class="form-group">
              <label for="psku_desc">Parent SKU Description:</label>
              <input type="text" class="form-control" name="psku_desc" value="{{ $psku->psku_desc }}">
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
@endsection