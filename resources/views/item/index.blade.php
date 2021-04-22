@extends('layouts.app')

@section('content')
  <div class="card">
  <div class="card-header">
    <div>
      <h3>Items</h3>
    </div>
      <a href="{{ route('item.create')}}" class="btn btn-success float-left">Add New Item</a>
  </div>
  <div class="card-body">
  <table class="table table-striped" border="0">
    <thead>
        <tr>
          <th class="centered">Item Name</th>
          <th class="centered">Item Description</th>
          <th class="centered">Category</th>
          <th class="centered">Sub Category</th>
          <th class="centered">SKU</th>
          <th class="centered">Supplier</th>
          <th class="centered">Quantity</th>
          <th class="centered">Price</th>
          <th class="centered">Active/Inactive</th>
          <th class="centered" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td class="centered">{{$item->item_name}}</td>
            <td class="centered">{{$item->item_desc}}</td>
            <td class="centered">{{$cat_array[$item->cat_id]}}</td>
            <td class="centered">{{$subcat_array[$item->subcat_id]}}</td>
            <td class="centered">{{$sku_array[$item->sku_id]}}</td>
            <td class="centered">{{$supp_array[$item->supp_id]}}</td>
            <td class="centered">{{$item->qty}}</td>
            <td class="centered"><?php echo "₱"; ?>{{number_format($item->price,2)}}</td>
            @if ($item->is_active === 1)
            <td class="centered">Active</td>
            @else
            <td class="centered">Inactive</td>
            @endif
            <td class="centered">
              <a href="{{ route('item.edit',$item->id)}}" class="btn btn-primary">Edit</a>
              @if ($item->is_active === 1)
              <a href="{{ route('itemsdeactivate',$item->id)}}" class="btn btn-secondary">Deactivate</a> 
              @else
              <a href="{{ route('itemsactivate',$item->id)}}" class="btn btn-secondary">Activate</a> 
              @endif
              <a href="{{ route('items.destroy', $item->id)}}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="float: left;">{{ $items->links() }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
@endsection