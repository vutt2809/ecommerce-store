@extends('frontend.main_master')

@section('content')

<style>
    table tr {
        border-bottom: 1px solid #ccc;
    }
</style>

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Account</a></li>
                    <li class="breadcrumb-item active">My Orders</li>
                </ul>
            </div>
        </div>
        <div class="row">
            @include('frontend.user.sidebar')

            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h4>Shipping Details</h4></div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                            <tr>
                                <th>Shipping Name</th>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Email</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th>Division</th>
                                <td>{{ $order->division->division_name }}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{ $order->district->district_name }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $order->state->state_name }}</td>
                            </tr>
                            <tr>
                                <th>Post Code</th>
                                <td>{{ $order->post_code }}</td>
                            </tr>

                            <tr>
                                <th>Order Date</th>
                                <td>{{ $order->order_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h4>Order Details <span class="text-primary">Invoice: {{ $order->invoice_no }}</span></h4></div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td>{{ $order->payment_method }}</td>
                            </tr>
                            @if ($order->transaction_id)
                            <tr>
                                <th>Transaction ID</th>
                                <td>{{ $order->transaction_id }}</td>
                            </tr>
                            @else
                            @endif
                            <tr>
                                <th>Invoice </th>
                                <td class="text-danger"><b>{{ $order->invoice_no }}</b></td>
                            </tr>
                            <tr>
                                <th>Order Total</th>
                                <td><span class="text-info"><b>${{ $order->amount }}</b></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge badge-pill badge-warning" style="background: #418DB9">{{ $order->status }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="row">
                        <h2>Order Item</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="background: #e2e2e2; ">
                                        <td class="col-md-1">
                                            <label for="">Image</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Product Name</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">Product Code</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Color</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">Size</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">Quantity</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">Price</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">Subtotal</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">Review</label>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItem as $item)
                                    <tr>
                                        <td class="col-md-1">
                                            <label for=""><img src="{{ asset($item->product->product_thumbnail) }}" alt="" width="100%"></label>
                                        </td>
                                        <td class="col-md-3">
                                            <label for="">{{ $item->product->product_name_en }}</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">{{ $item->product->product_code }}</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label for="">{{ $item->color }}</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">{{ $item->size }}</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">{{ $item->qty }}</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for="">{{ $item->price }}</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label for=""><span class="text-success"><b>{{ $item->price * $item->qty }}</b></span></label>
                                        </td>
                                        <td class="col-md-1">
                                            <a href="{{ route('review.create', $item->product->product_id, $item->user->user_id) }}" class="btn btn-info">Review</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($order->status !== "delivered")
                    @else
                        @php
                        $order = App\Models\Order::where('id', $order->id)->where('return_reason', '=', NULL)->first();
                        @endphp

                        @if ($order)
                        <form action="{{ route('return.order', $order->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <h2>Order Return Reason</h2>
                                    <textarea name="return_reason" id="" rows="5" class="form-control">{{ $order->return_reason }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Order Return</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <span class="badge badge-pill badge-warning" style="background: red">You have send return request for this order</span>
                        @endif
                    @endif
                </div>
            </div>




        </div>
    </div>
</div>

@endsection
