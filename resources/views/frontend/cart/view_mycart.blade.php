@section('title')
My Shopping Cart
@endsection
@extends('frontend.main_master')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            <li><a href="{{ url('/')}}">Home</a></li>
                <li class='active'>My Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
                <h2><strong>My Shopping Cart</strong></h2>
				<div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="item">Image</th>
                                    <th class="item">Product Name</th>
                                    <th class="item">Color</th>
                                    <th class="item">Size</th>
                                    <th class="item">Quantity</th>
                                    <th class="item">Subtotal</th>
                                    <th class="last-item">Grandtotal</th>
                                </tr>
                            </thead>
                            <tbody id="my-cart"></tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4"></div>
                
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if(Session::has('coupon'))

                    @else
                    <table class="table" id="couponField">
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Discount Code</span>
                                    <p>Enter your coupon code if you have one..</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon.." id="coupon_name">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    @endif
                </div>

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id="couponCalField">
                            
                        </thead><!-- /thead -->
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a href="{{ route('checkout') }}">
                                            <span class="">Checkout with multiples address!</span>
                                        </div>
                                    </td>
                                </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->			
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        @include('frontend.body.brands')
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

