@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Division</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('division.update', $division->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Division Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="division_name" name="division_name" class="form-control" value="{{ $division->division_name }}">
                                </div>
                                @error('division_name')
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
        </div>
    </section>
</div>

@endsection