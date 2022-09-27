@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub-SubCategory</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('subsubcategory.update') }}" enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" name="id" value="{{ $subSubCategory->id }}">

                            <div class="form-group">
								<h5>Category Select<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" id="category_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == $subSubCategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                        @endforeach
									</select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>

                            <div class="form-group">
								<h5>SubCategory Select<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" id="subcategory_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select SubCategory</option>
                                        @foreach ($subCategories as $subCategory)
										<option value="{{ $subCategory->id }}" {{ $subCategory->id == $subSubCategory->subcategory_id ? 'selected' : '' }}>{{ $subCategory->subcategory_name_en }}</option>
                                        @endforeach
									</select>
                                @error('subcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>

                            <div class="form-group">
                                <h5>Sub SubCategory Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subsubcategory_name_en" name="subsubcategory_name_en" class="form-control"  value="{{ $subSubCategory->subsubcategory_name_en }}">
                                </div>
                                @error('subsubcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Sub SubCategory Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subsubcategory_name_vn" name="subsubcategory_name_vn" class="form-control" value="{{ $subSubCategory->subsubcategory_name_vn }}">
                                </div>
                                @error('subsubcategory_name_vn')
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();

            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>