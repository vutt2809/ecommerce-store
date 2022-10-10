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
                            <li class="breadcrumb-item active" aria-current="page">Blog Post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Post List - <span class="badge badge-pill badge-info">{{ count($blogPosts) }}</span></h3>
                        <a href="{{ route('add.post') }}" class="btn btn-success" style="float: right">Add Post</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Post Image</th>
                                    <th>Post title EN</th>
                                    <th>Post title VN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogPosts as $post)
                                    <tr>
                                        <td>{{$post->category->blog_category_name_en}}</td>
                                        <td width="30%"><img src="{{ asset($post->post_image) }}" style="width: 60%"/></td>
                                        <td>{{$post->post_title_en}}</td>
                                        <td>{{$post->post_title_vn}}</td>
                                        <td>
                                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('post.delete', $post->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection