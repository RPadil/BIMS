@extends('layouts.app')

@section('content')

<!-- create -->
<div class="card">
  <div class="card-header">
    <h3>New SKU</h3>
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
      <form method="post" action="{{ route('sku.store') }}">
          <div class="form-group">
              @csrf
              <label for="sku_name">SKU Name:</label>
              <input type="text" class="form-control" name="sku_name"/>
          </div>
          <div class="form-group">
              <label for="sku_desc">SKU Description:</label>
              <input type="text" class="form-control" name="sku_desc"/>
          </div>
          <div class="form-group">
              <label for="cat_name">Category:</label>
              <select class="form-control" name="cat_name" id="cat_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $value)
                <option value="{{ $value->id }}">{{ $value->cat_name }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="cat_name">Sub Category:</label>
              <select class="form-control" name="subcat_name" id="subcat_id">
              </select>
          </div>
          <div class="form-group" style="float: center;">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
          <a href="{{ url()->previous() }}" class="btn btn-secondary"> Back </a>
          </div>
      </form>
  </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
          $(document).ready(function() {
          $('#cat_id').on('change', function() {
              var getStId = $(this).val();
              if(getStId) {
                  $.ajax({
                      url: '/subcatdd/'+getStId,
                      type: "GET",
                      data : {"_token":"{{ csrf_token() }}"},
                      dataType: "json",
                      success:function(data) {
                          //console.log(data);
                        if(data){
                          $('#subcat_id').empty();
                          $('#subcat_id').focus;
                          $('#subcat_id').append('<option value="">-- Select Sub Category --</option>'); 
                          $.each(data, function(key, value){
                          $('select[name="subcat_id"]').append('<option value="'+ value.id +'">' + value.subcat_name+ '</option>');
                      });
                    }else{
                      $('#subcat_id').empty();
                    }
                    }
                  });
              }else{
                $('#subcat_id').empty();
              }
          });
      });
    </script>
@endsection