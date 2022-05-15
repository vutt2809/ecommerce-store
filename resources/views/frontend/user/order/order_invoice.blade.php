<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
    <title>Invoice</title>
</head>

<style>
    body{
    margin-top:20px;
    color: #484b51;
    }
    .text-secondary-d1 {
        color: #728299!important;
    }
    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }
    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }
    .brc-default-l1 {
        border-color: #dce9f0!important;
    }

    .ml-n1, .mx-n1 {
        margin-left: -.25rem!important;
    }
    .mr-n1, .mx-n1 {
        margin-right: -.25rem!important;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem!important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
    }

    .text-grey-m2 {
        color: #888a8d!important;
    }

    .text-success-m2 {
        color: #86bd68!important;
    }

    .font-bolder, .text-600 {
        font-weight: 600!important;
    }

    .text-110 {
        font-size: 110%!important;
    }
    .text-blue {
        color: #478fcc!important;
    }
    .pb-25, .py-25 {
        padding-bottom: .75rem!important;
    }

    .pt-25, .py-25 {
        padding-top: .75rem!important;
    }
    .bgc-default-tp1 {
        background-color: rgba(121,169,197,.92)!important;
    }
    .bgc-default-l4, .bgc-h-default-l4:hover {
        background-color: #f3f8fa!important;
    }
    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }
    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120%!important;
    }
    .text-primary-m1 {
        color: #4087d4!important;
    }

    .text-danger-m1 {
        color: #dd4949!important;
    }
    .text-blue-m2 {
        color: #68a3d5!important;
    }
    .text-150 {
        font-size: 150%!important;
    }
    .text-60 {
        font-size: 60%!important;
    }
    .text-grey-m1 {
        color: #7b7d81!important;
    }
    .align-bottom {
        vertical-align: bottom!important;
    }

    .table-responsive tr td {
        border-bottom: 1px solid #ccc;
    }
</style>

<body>
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: #{{ $order->invoice_no }}
                </small>
            </h1>

            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
            </div>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                                <h2>SnowRainShop</h2>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $order->name }} </span>
                            </div>
                            <div class="text-grey-m2">
                                

                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $order->phone }}</b></div>
                                <div class="my-1"><i class="fa fa-envelope fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $order->email }}</b></div>

                                <div class="my-1">
                                    <i class="fa fa-location-arrow fa-flip-horizontal text-secondary"></i>
                                    <b>{{ $order->division->division_name }}, {{ $order->district->district_name }}, {{ $order->state->state_name }}</b>
                                </div>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Post Code: </span>
                                <span class="text-600 text-110 align-middle">{{ $order->post_code }}</span>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">Invoice</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{ $order->invoice_no }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ $order->created_at }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Delivery Date:</span> {{ $order->delivered_date }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Payment Type:</span> {{ $order->payment_method }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{ $order->status }}</span></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="mt-4">

                        <table class="table-responsive">
                            <thead class="text-600 text-white bgc-default-tp1 py-25">
                                <tr>
                                    <th class="py-3 col-sm-1"> &nbsp; Image</th>
                                    <th class="py-3 col-sm-4">Product Name</th>
                                    <th class="py-3 col-sm-1">Size</th>
                                    <th class="py-3 col-sm-1">Color</th>
                                    <th class="py-3 col-sm-2">Code</th>
                                    <th class="py-3 col-sm-1">Unit Price</th>
                                    <th class="py-3 col-sm-2">Total</th>
                                </tr>
                            </thead>

                            <tbody class="text-95 text-secondary-d3">
                                @foreach ($orderItem as $item)
                                <tr>
                                    <td class="py-3 col-sm-1"><img src="{{ asset($item->product->product_thumbnail) }}" width="100%" alt=""></td>
                                    <td class="py-3 col-sm-4">{{ $item->product->product_name_en }}</td>
                                    <td class="py-3 col-sm-1">{{ $item->size }}</td>
                                    <td class="py-3 col-sm-1">{{ $item->color }}</td>
                                    <td class="py-3 col-sm-2">{{ $item->product->product_code }}</td>
                                    <td class="py-3 col-sm-1">${{ $item->price }}</td>
                                    <td class="py-3 col-sm-2"><b>${{ $item->price * $item->qty}}</b></td>  
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>

                        <div class="row border-b-2 brc-default-l2"></div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Extra note such as company or payment information...
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        SubTotal
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1">${{ $order->amount }}</span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Tax (10%)
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">$225</span>
                                    </div>
                                </div>

                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2"><b>${{ $order->amount }}</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div class="mb-5">
                            <span class="text-secondary-d1 text-105">Thank you for your business</span>
                            <a href="#" class="btn btn-info btn-bold px-4 float-end mt-3 mt-lg-0 text-white">Pay Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>