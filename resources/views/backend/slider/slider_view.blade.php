@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Slider Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->slider_img) }}" style="width: 70px; height: 40px;"></td>
                                        <td>
                                            @if ($item->title == NULL)
                                            <span class="badge badge-pill badge-warning">No Title</span>
                                            @else
                                            {{$item->title}}
                                            @endif
                                        </td>
                                        <td> 
                                            @if ($item->description == NULL)
                                            <span class="badge badge-pill badge-warning">No Description</span>
                                            @else
                                            {{$item->description}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                            @if ($item->status == 1)
                                            <a href="{{ route('slider.inactive', $item->id) }}" class="btn btn-sm btn-warning" title="InActive Now"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('slider.active', $item->id) }}" class="btn btn-sm btn-success" title="Active Now"><i class="fa fa-arrow-up"></i></a>
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
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Slider Title<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="title" name="title" class="form-control" >
                                </div>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Description<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="description" name="description" class="form-control" >
                                </div>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Slider Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="slider_img" name="slider_img" class="form-control" >
                                </div>
                                @error('slider_img')
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