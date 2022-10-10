@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Blog Post</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('post.update', $blogPost->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Blog Category Select<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="category_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Blog Category</option>
                                                        @foreach ($blogCategories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $blogPost->category_id ? 'selected' : ' ' }} >{{ $category->blog_category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Post Title English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_en" id="post_title_en" class="form-control" value="{{ $blogPost->post_title_en }}"> 
                                                    @error('post_title_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Post Title VietNam <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_vn" id="post_title_vn" class="form-control" value="{{ $blogPost->post_title_vn }}"> 
                                                    @error('post_title_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Main Thumnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="post_image" id="post_image" class="form-control"> 
                                                    @error('post_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="{{ asset($blogPost->post_image ) }}" id="mainThumb" alt="" class="mt-2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Post Details English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="post_details_en" id="editor1">{{ $blogPost->post_details_en }}</textarea> 
                                                    @error('post_details_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Post Details VietNamese <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="post_details_vn" id="editor2" rows="10" cols="80">{{ $blogPost->post_details_vn }}</textarea> 
                                                    @error('post_details_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save Post" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('input#post_image').change(function() {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    })
</script>

