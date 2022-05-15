@section('title')
Checkout
@endsection
@extends('frontend.main_master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/')}}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->


<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">
                                <!-- panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                            <span>1</span>Checkout Method
                                        </a>
                                    </h4>
                                </div>
                                <!-- panel-heading -->
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <!-- guest-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                                <form class="register-form" method="POST" action="{{ route('checkout.store')}}" >  
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="info-title" for=""><b>Shipping Name</b> <span>*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" name="shipping_name" placeholder="Full Name" value="{{ Auth::user()->name }}" require="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for=""><b>Shipping Email</b><span>*</span></label>
                                                        <input type="email" class="form-control unicase-form-control text-input" name="shipping_email" placeholder="Email" value="{{ Auth::user()->email }}" require="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for=""><b>Shipping Phone</b> <span>*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" name="shipping_phone" placeholder="Email" value="{{ Auth::user()->phone }}" require="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for=""><b>Post Code</b> <span>*</span></label>
                                                        <input type="text" class="form-control unicase-form-control text-input" name="post_code" placeholder="Post Code" require="">
                                                    </div>
                                            </div>
                                            <!-- guest-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <h5><b>Division Select </b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">Select Division</option>
                                                            @foreach($divisions as $item)
                                                            <option value="{{ $item->id }}">{{ $item->division_name }}</option>	
                                                            @endforeach
                                                        </select>
                                                        @error('division_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->


                                                <div class="form-group">
                                                    <h5><b>District Select</b>  <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">Select District</option>
                                                            
                                                        </select>
                                                        @error('district_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->


                                                <div class="form-group">
                                                    <h5><b>State Select</b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">Select State</option>
                                                        </select>
                                                        @error('state_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->
                                                                
                                                                    
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Notes <span>*</span></label>
                                                    <textarea class="form-control" cols="30" rows="5" placeholder="Notes" name="notes"></textarea>
                                                </div>  <!-- // end form group  -->
                                            </div>
                                            <!-- already-registered-login -->
                                        </div>
                                    </div>
                                    <!-- panel-body  -->
                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->
                            <!-- checkout-step-02  -->
                            <div class="panel panel-default checkout-step-02">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                            <span>2</span>Billing Information
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>
                                </div>
                            </div>
                            <!-- checkout-step-02  -->
                        </div><!-- /.checkout-steps -->
                    </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                        <li style="margin-top: 20px;">
                                            <img src="{{ asset($item->attributes->image )}}" alt="" style="width: 20%">
                                            <strong>Qty : </strong>
                                            ({{ $item->quantity }}),

                                            <strong>Color : </strong>
                                            {{ $item->attributes->color }},

                                            <strong>Size : </strong>
                                            {{ $item->attributes->size }}
                                        </li>
                                        @endforeach <hr>
                                        <li>
                                            @if (session()->get('coupon'))
                                            <strong>Subtotal:</strong> ${{ $cartTotal }} <hr>
                                            <strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount']}}%)<hr>
                                            <strong>Coupon Discount: </strong> ${{ session()->get('coupon')['discount_amount'] }}  <hr>
                                            <strong>Grand Total:</strong> ${{ session()->get('coupon')['total_amount'] }}
                                            <hr>
                                            @else
                                            <strong>SubTotal:  <span class="badge total"></span> ${{ $cartTotal }} </strong>  <hr>
                                            <strong>Grand Total:  <span class="badge total"></span> ${{ $cartTotal }} </strong> 
                                            @endif
                                        </li>
                                        
                                    </ul> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->

                    <!-- Payment Method -->
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="payment_method" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="payment_method" value="cash">
                                        <img src="{{ asset('frontend/assets/images/payments/6.png') }}" alt="">
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Method -->
                </div>
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/shipping/get-district') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/shipping/get-state') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });

</script>