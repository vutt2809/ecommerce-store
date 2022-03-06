@extends('admin.admin_master')

@section('admin')



<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add SubSubCategory</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('subsubcategory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Category Select<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" id="category_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Category</option>
                                        @foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                        @endforeach
									</select>
                                </div>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
							</div>
                            
                            <div class="form-group mt-3">
								<h5>SubCategory Select<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" id="subcategory_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select SubCategory</option>
									</select>
                                </div>
                                @error('subcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
							</div>

                            <div class="form-group mt-3">
                                <h5>Sub-SubCategory Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subsubcategory_name_en" name="subsubcategory_name_en" class="form-control" >
                                </div>
                                @error('subsubcategory_name_en')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name VietNam<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="subsubcategory_name_vn" name="subsubcategory_name_vn" class="form-control" >
                                </div>
                                @error('subsubcategory_name_vn')
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
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub->SubCategory List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>SubCategory Name</th>
                                    <th>Sub-SubCategory Name EN</th>
                                    <th>SubCategory Name VN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subsubcategories as $subsubcategory)
                                    <tr>
                                        <td>{{ $subsubcategory->category->category_name_en }} </td>
                                        <td>{{ $subsubcategory->subcategory->subcategory_name_en }} </td>
                                        <td>{{ $subsubcategory->subsubcategory_name_en }}</td>
                                        <td>{{ $subsubcategory->subsubcategory_name_vn }}</td>
                                        <td>
                                            <a href="{{ route('subsubcategory.edit', $subsubcategory->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('subsubcategory.delete', $subsubcategory->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
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