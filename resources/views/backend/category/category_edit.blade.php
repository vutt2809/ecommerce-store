@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('category.update', $category->category_id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <div class="form-group">
                                <h5>Category Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="category_name_en" name="category_name_en" class="form-control"  value="{{ $category->category_name_en }}">
                                </div>
                                @error('category_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Category Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="category_name_vn" name="category_name_vn" class="form-control" value="{{ $category->category_name_vn }}">
                                </div>
                                @error('category_name_vn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>category Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="category_icon" name="category_icon" class="form-control" value="{{ $category->category_icon }}" >
                                </div>
                                @error('category_icon')
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
                        <h3 class="box-title">Category Icon</h3>
                    </div>
                    <div class="box-body text-center">
                        <span class="text-warning"><i class="{{$category->category_icon}}" style="font-size: 200px;"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection