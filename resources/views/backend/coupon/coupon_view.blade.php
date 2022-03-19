@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupon List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Coupon Name</th>
                                    <th>Coupon Discount</th>
                                    <th>Validity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_discount }}%</td>
                                        <td>{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}</td>
                                        <td>
                                            @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-pill badge-success"> Valid </span>
                                            @else
                                            <span class="badge badge-pill badge-danger"> Invalid </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Coupon Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="coupon_name" name="coupon_name" class="form-control" >
                                </div>
                                @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Coupon Discount (%)<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="coupon_discount" name="coupon_discount" class="form-control" >
                                </div>
                                @error('coupon_discount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Coupon Validity<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" id="coupon_validity" name="coupon_validity" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" >
                                </div>
                                @error('coupon_validity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Add New">
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection