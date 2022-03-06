@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $slider->id }}">
                            <input type="hidden" name="old_img" value="{{ $slider->slider_img }}">
                            <div class="form-group">
                                <h5>Slider Title<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $slider->title }}">
                                </div>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Description<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="description" name="description" class="form-control" value="{{ $slider->description }}">
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
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider Image</h3>
                    </div>
                    <div class="box-body">
                        <img src="{{ asset($slider->slider_img) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection