@extends('site.template')
@section('content')
<br /> <br />
    <div class="container">
        <div class="row">
            <br /> <br />
            <div class="col-md-12">
            <h2>Checkout</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h5>Billling and Shipping Information</h5>
                <form action="">
                    Full Name : <input type="text" name= "name"> <br />
                    Address : <input type="text" name="address"> <br />
                    Email Address : <input type="email" name="email"> <br />
                    Contact Number : <input type="number" name="phone"><br />
                </form>
            </div>
            <div class="col-md-4">
                <h5>Your Order</h5>
                <ul>
                    <li>productnameX2       <span style="font-weight:bold; float:right">NPR 2000</span></li>
                    <li>productnameX2       <span style="font-weight:bold; float:right">NPR 2000</span></li>
                    <li><strong>Sub Total</strong> : <span style="font-weight:bold; float:right">NPR 4000</span> </li>
                    <li><strong>Shipping Charge</strong> : <span style="font-weight:bold; float:right">NPR 0.0</span> </li>
                    <li><strong>Grand Total</strong> : <span style="font-weight:bold; float:right">NPR 4000.0</span> </li>
                </ul>
                <br />
                <hr>
                <h5>Payment Method</h5>
                <ul>
                    <li><input type="radio" name="paymentmethod"> Esewa</li>
                    <li><input type="radio" name="paymentmethod"> Cash on Delivery</li>

                </ul>
                <hr>
                <input class="btn btn-primary" type="submit" value="Pay Now">
               
            </div>
        </div>
    </div>
@stop