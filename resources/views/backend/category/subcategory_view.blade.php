@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SubCategory List -  <span class="badge badge-pill badge-info">{{ count($subCategories) }}</span> </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>SubCategory Name EN</th>
                                    <th>SubCategory Name VN</th>
                                    <th width="16%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $subCategory->category->category_name_en }}</td>
                                        <td>{{ $subCategory->subcategory_name_en }}</td>
                                        <td>{{ $subCategory->subcategory_name_vn }}</td>
                                        <td>
                                            <a href="{{ route('subcategory.edit', $subCategory->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('subcategory.delete', $subCategory->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add SubCategory</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
								<h5>Parent Category<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" id="category_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                        @endforeach
									</select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>
                            <div class="form-group">
                                <h5>SubCategory Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subcategory_name_en" name="subcategory_name_en" class="form-control" >
                                </div>
                                @error('subcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>SubCategory Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subcategory_name_vn" name="subcategory_name_vn" class="form-control" >
                                </div>
                                @error('subcategory_name_vn')
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