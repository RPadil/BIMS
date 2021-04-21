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
          <th>Item Name</th>
          <th>Item Description</th>
          <th>Category</th>
          <th>Sub Category</th>
          <th>SKU</th>
          <th>Supplier</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Active/Inactive</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->item_name}}</td>
            <td>{{$item->item_desc}}</td>
            <td>{{$cat_array[$item->cat_id]}}</td>
            <td>{{$subcat_array[$item->subcat_id]}}</td>
            <td>{{$sku_array[$item->sku_id]}}</td>
            <td>{{$supp_array[$item->supp_id]}}</td>
            <td>{{$item->qty}}</td>
            <td><?php echo "₱"; ?>{{number_format($item->price,2)}}</td>
            @if ($item->is_active === 1)
            <td>Active</td>
            @else
            <td>Inactive</td>
            @endif
            <td><a href="{{ route('item.edit',$item->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('item.destroy', $item->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="float: right;">{{ $items->links() }}</td>
        <td></td>
        <td></td>
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