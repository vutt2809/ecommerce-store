@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Data Tables</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Brand</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $brand->id }}">
                            <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                            <div class="form-group">
                                <h5>Brand Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="brand_name_en" name="brand_name_en" class="form-control"  value="{{ $brand->brand_name_en }}">
                                </div>
                                @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Brand Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="brand_name_vn" name="brand_name_vn" class="form-control" value="{{ $brand->brand_name_vn }}">
                                </div>
                                @error('brand_name_vn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Brand Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="brand_image" name="brand_image" class="form-control" value="{{ $brand->brand_image }}" >
                                </div>
                                @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update">
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand Image</h3>
                    </div>
                    <div class="box-body text-center">
                        <img src="{{ asset($brand->brand_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection