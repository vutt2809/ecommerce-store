@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Book List <span class="badge badge-pill badge-info">{{ count($products) }}</span></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th width="30%">Product Name EN</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th width="18%">Action</th>
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
                                    <td>{{ $item->selling_price }} $</td>
                                    <td>{{ $item->product_qty }} Pic</td>
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
                                        @if ($item->status == 1)
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('product.delete', $item->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                        @if ($item->status == 1)
                                        <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-sm btn-warning" title="InActive Now"><i class="fa fa-arrow-down"></i></a>
                                        @else
                                        <a href="{{ route('product.active', $item->id) }}" class="btn btn-sm btn-success" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                        @endif
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