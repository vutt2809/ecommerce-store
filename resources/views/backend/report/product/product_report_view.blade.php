@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Report</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Admin</li>
                            <li class="breadcrumb-item active" aria-current="page">Report Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Best Seller</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('top-n-bestseller') }}" >
                            @csrf
                            <div class="form-group">
                                <h5>Select Top N<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="number" id="number" name="number" class="form-control" >
                                </div>
                                @error('number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Apply" onclick="searchByDate()">
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Best Seller By Month</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('search-by-month') }}">
                            @csrf
                            <div class="form-group">
                                <h5>Select Top N<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="number" id="number" name="number" class="form-control" >
                                </div>
                                @error('number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Select Month<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="month" id="month" class="form-control">
                                        <option label="Choose One"></option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                @error('month')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Select Year<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="year_name" id="year_name" class="form-control">
                                        <option label="Choose One"></option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Apply">
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search By Year</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('search-by-year') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Select Year<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="year_name" id="year_name" class="form-control">
                                        <option label="Choose One"></option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                @error('brand_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Apply">
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
        </div>
         
    </section>
</div>

@endsection