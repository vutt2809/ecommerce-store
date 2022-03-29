@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit District</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('district.update', $district->id ) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="division_id" id="division_id" class="form-control">
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $district->division_id == $division->id ? 'selected' : ''}}>{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="district_name" name="district_name" class="form-control" value="{{ $district->district_name }}">
                                </div>
                                @error('district_name')
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