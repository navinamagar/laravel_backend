@extends('site.template')
@section('content')
    <div id="card" style="padding:50px 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br /> <br />
                    <h3>Carts</h3>
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Cost</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        @foreach($carts as $jyoti)
                            <!-- @php $productinfo = App\Models\Product::where('id', $jyoti->product_id)->limit(1)->first(); @endphp -->
                            @php $productinfo = App\Models\Product::find($jyoti->product_id); @endphp
                        <tr>
                            <td><img src="{{asset('site/uploads/product/'.$productinfo->image)}}" alt="" width="100"></td>
                            <td>{{$productinfo->title}}</td>
                            <td>{{$jyoti->qty}}</td>
                            <td>{{$jyoti->cost}}</td>
                            <td>{{$jyoti->totalcost}}</td>
                            <td><a href="">Remove</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
</div>
@stop