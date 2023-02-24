@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="content-header">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="page-title">Order Details</h3>
                                <div class="d-inline-block align-items-center">
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                            <li class="breadcrumb-item" aria-current="page">Orders</li>
                                            <li class="breadcrumb-item active" aria-current="page">Pending Order Details</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row box-body">
                        <div class="col-md-6 col-12">
                            <div class="box box-bordered border-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title"><strong>Shipping Details</strong> box</h4>
                                </div>
                                <div class="box-body">
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
                        <div class="col-md-6 col-12">
                            <div class="box box-bordered border-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title"><strong>Order Details</strong> box</h4>
                                </div>
                                <div class="box-body">
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
                                        <tr>
                                            <th></th>
                                            <td>
                                                @if ($order->status == 'pending')
                                                <a href="{{ route('pending-confirm', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Confirmed Order</a>
                                                @elseif ($order->status == 'confirmed')
                                                <a href="{{ route('confirm-processing', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Processing Order</a>
                                                @elseif ($order->status == 'processing')
                                                <a href="{{ route('processing-picked', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Picked Order</a>
                                                @elseif ($order->status == 'picked')
                                                <a href="{{ route('picked-shipped', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Shipped Order</a>
                                                @elseif ($order->status == 'shipped')
                                                <a href="{{ route('shipped-delivered', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Delivered Order</a>
                                                @elseif ($order->status == 'delivered')
                                                <a href="{{ route('delivered-cancel', $order->id) }}" class="btn btn-block btn-success" id="confirmed_order">Cancel Order</a>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="box box-bordered border-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title"><strong>Order Details</strong> box</h4>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td class="col-md-1">
                                                        <label for="">Image</label>
                                                    </td>
                                                    <td class="col-md-3">
                                                        <label for="">Product Name</label>
                                                    </td>
                                                    <td class="col-md-2">
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
                                                        <label for="">$ {{ $item->price }}</label>
                                                    </td>
                                                    <td class="col-md-1">
                                                        <label for=""><span class="text-success"><b>$ {{ $item->price * $item->qty }}</b></span></label>
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
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
