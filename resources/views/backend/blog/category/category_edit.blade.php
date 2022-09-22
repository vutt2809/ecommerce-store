@extends('admin.admin_master')

@section('admin')

<div class="container-full">

    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Admin</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Blog</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Blog Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Blog Category</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('blogcategory.update', $blogcategory->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blogcategory->id }}">
                            <div class="form-group">
                                <h5>Blog Category Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="blog_category_name_en" name="blog_category_name_en" class="form-control"  value="{{ $blogcategory->blog_category_name_en }}">
                                </div>
                                @error('blog_category_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Blog Category Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="blog_category_name_vn" name="blog_category_name_vn" class="form-control" value="{{ $blogcategory->blog_category_name_vn }}">
                                </div>
                                @error('blog_category_name_vn')
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
    </section>
</div>

@endsection