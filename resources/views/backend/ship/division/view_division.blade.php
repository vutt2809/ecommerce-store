@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Division List  -  <span class="badge badge-pill badge-info">{{ count($divisions) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Division Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisions as $division)
                                    <tr>
                                        <td>{{ $division->division_name }}</td>
                                        <td>
                                            <a href="{{ route('division.edit', $division->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('division.delete', $division->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add Division</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('division.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Division Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="division_name" name="division_name" class="form-control" >
                                </div>
                                @error('division_name')
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