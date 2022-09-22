@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top<span class="badge badge-pill badge-info">{{ count($products) }}</span> Best Seller Book</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th width="30%">Product Name EN</th>
                                    <th>Price</th>
                                    <th>Total Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                    
                                    <tr>
                                        <td class="text-center">
                                            @if ($item->category_id == 2)
                                            <img src="{{ asset( $item->product_thumbnail) }}" style="width: 100px; height: 80px;">
                                            @else
                                            <img src="{{ asset( $item->product_thumbnail) }}" style="width: 100px;">
                                            @endif
                                        </td>
                                        <td>{{ $item->product_name_en }}</td>
                                        
                                        <td>
                                            @if($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">NoDiscount</span>
                                            @else
                                                @php
                                                $discount = ceil(($item->selling_price - $item->discount_price) * 100 / $item->selling_price)
                                                @endphp
                                                <span class="badge badge-pill badge-info">{{$discount}}%</span>
                                            @endif
                                        </td>

                                        <td>
                                            
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
    </section>
</div>

@endsection