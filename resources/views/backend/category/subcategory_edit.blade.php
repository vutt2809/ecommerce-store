@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit SubCategory</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('subcategory.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subcategory->id }}">

                            <div class="form-group">
								<h5>Category Select<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" id="category_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                        @endforeach
									</select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>

                            <div class="form-group">
                                <h5>SubCategory Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subcategory_name_en" name="subcategory_name_en" class="form-control"  value="{{ $subcategory->subcategory_name_en }}">
                                </div>
                                @error('subcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>SubCategory Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subcategory_name_vn" name="subcategory_name_vn" class="form-control" value="{{ $subcategory->subcategory_name_vn }}">
                                </div>
                                @error('subcategory_name_vn')
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