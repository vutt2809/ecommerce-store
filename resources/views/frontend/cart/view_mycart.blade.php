@section('title')
My Shopping Cart
@endsection
@extends('frontend.main_master')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
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
                            <tbody id="my-cart">
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        @include('frontend.body.brands')
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection