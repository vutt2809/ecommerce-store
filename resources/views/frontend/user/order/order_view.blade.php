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
            <div class="col-md-9">
                <h2>Order History</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="background: #e2e2e2; ">
                                <td class="col-md-2">
                                    <label for="">Date</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Total</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Payment Method</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="">Order</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Action</label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td class="col-md-2">
                                    <label for="">{{ $order->order_date }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">$ {{ $order->amount }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{ $order->payment_method }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{ $order->invoice_no }}</label>
                                </td>
                                <td class="col-md-1">
                                    {{-- <label for="">
                                        <span class="badge badge-pill" style="background: #418BD9;">{{ $order->status }}</span>
                                    </label> --}}

                                    <label for="">
                                        @if($order->status == 'pending')
                                        <span class="badge badge-pill badge-warning" style="background: #800080;"> Pending </span>

                                        @elseif($order->status == 'confirmed')
                                        <span class="badge badge-pill badge-warning" style="background: #0000FF;"> Confirmed </span>

                                        @elseif($order->status == 'processing')
                                        <span class="badge badge-pill badge-warning" style="background: #FFA500;"> Processing </span>

                                        @elseif($order->status == 'picked')
                                        <span class="badge badge-pill badge-warning" style="background: #808000;"> Picked </span>

                                        @elseif($order->status == 'shipped')
                                        <span class="badge badge-pill badge-warning" style="background: #808080;"> Shipped </span>

                                        @elseif($order->status == 'delivered')
                                        <span class="badge badge-pill badge-warning" style="background: #008000;"> Delivered </span>

                                        @else
                                        <span class="badge badge-pill badge-warning" style="background: #FF0000;"> Cancel </span>
                                        @endif

                                        @if ($order->return_order == 1)
                                        <span class="badge badge-pill badge-warning" style="background:red;">Return Requested </span>
                                        @endif

                                    </label>


                                </td>
                                <td class="col-md-3">
                                    <a href="{{ url('user/order-details/'.$order->id ) }}" class="btn btn-sm btn-info" title="View Detail"><i class="fas fa-eye"></i></a>
                                    <a target="_blank" href="{{ url('user/invoice-download/'.$order->id ) }}" class="btn btn-sm btn-success" title="Download Invoice"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
