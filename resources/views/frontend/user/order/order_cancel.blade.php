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
                <h2>Cancel Order</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="background: #e2e2e2; ">
                                <td class="col-md-2">
                                    <label for="">Cancel Date</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Total</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Return Reason</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="">Status</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Action</label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td class="col-md-2">
                                    <label for="">{{ $order->return_date }}</label>
                                </td> 
                                <td class="col-md-2">
                                    <label for="">$ {{ $order->amount }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{ $order->return_reason }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">{{ $order->invoice_no }}</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="">
                                        <span class="badge badge-pill" style="background: #418BD9;">{{ $order->status }}</span>    
                                        <span class="badge badge-pill" style="background: red;">Return Requested</span>    
                                    </label>
                                </td>
                                <td class="col-md-3">
                                    <a href="{{ url('user/order-details/'.$order->id ) }}" class="btn btn-sm btn-info" title="View Detail"><i class="fas fa-eye"></i></a>
                                    <a target="_blank" href="{{ url('user/invoice-download/'.$order->id ) }}" class="btn btn-sm btn-success" title="Download Invoice"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>

                            @empty
                            <h2 class="text-warning">Order Not Found</h2>
                            @endforelse 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection
