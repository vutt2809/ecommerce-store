@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Admin</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Blog</li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Post Category List - <span class="badge badge-pill badge-info">{{ count($blogCategories) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Blog Category Name EN</th>
                                    <th>Blog Category Name VN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogCategories as $category)
                                    <tr>
                                        <td>{{ $category->blog_category_name_en }}</td>
                                        <td>{{ $category->blog_category_name_vn }}</td>
                                        <td>
                                            <a href="{{ route('blogcategory.edit', $category->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('blogcategory.edit', $category->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add Blog Category</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('blogcategory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Category Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="blog_category_name_en" name="blog_category_name_en" class="form-control" >
                                </div>
                                @error('blog_category_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Category Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="blog_category_name_vn" name="blog_category_name_vn" class="form-control" >
                                </div>
                                @error('blog_category_name_vn')
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