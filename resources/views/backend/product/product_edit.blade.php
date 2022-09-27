@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Category Select<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="category_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ' ' }}>{{ $category->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>SubCategory Select<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" id="subcategory_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select SubCategory</option>
                                                        @foreach ($subCategories as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $product->subcategory_id ? 'selected' : ' ' }}>{{ $item->subcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('subcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Sub-SubCategory Select<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" id="subsubcategory_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Sub-SubCategory</option>
                                                        @foreach ($subSubCategories as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $product->subsubcategory_id ? 'selected' : ' ' }}>{{ $item->subsubcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('subsubcategory_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Brand Select<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" id="brand_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Brand</option>
                                                        @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : ' '}}>{{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Name EN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" id="product_name_en" class="form-control" value="{{ $product->product_name_en }}"> 
                                                    @error('product_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Name VN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_vn" id="product_name_vn" class="form-control" value="{{ $product->product_name_vn }}"> 
                                                    @error('product_name_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Code<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $product->product_code }}"> 
                                                    @error('product_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" id="product_qty" class="form-control" value="{{ $product->product_qty }}"> 
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ $product->selling_price }}" > 
                                                    @error('selling_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" id="discount_price" class="form-control" value="{{ $product->discount_price }}"> 
                                                    @error('discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags EN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" id="product_tags_en" class="form-control" value="{{ $product->product_tags_en }}"  data-role="tagsinput" placeholder="add tags"> 
                                                    @error('product_tags_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size EN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" id="product_size_en" class="form-control" value="{{ $product->product_size_en }}" data-role="tagsinput" placeholder="add tags"> 
                                                    @error('product_size_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color EN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" id="product_color_en" class="form-control" value="{{ $product->product_color_en }}" data-role="tagsinput" placeholder="add tags"> 
                                                    @error('product_color_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags VN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_vn" id="product_tags_vn" class="form-control" value="{{ $product->product_tags_vn }}" data-role="tagsinput" placeholder="add tags""> 
                                                    @error('product_tags_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size VN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_vn" id="product_size_vn" class="form-control" value="{{ $product->product_size_vn }}" data-role="tagsinput" placeholder="add tags"> 
                                                    @error('product_size_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color VN <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_vn" id="product_color_vn" class="form-control" value="{{ $product->product_color_vn }}" data-role="tagsinput" placeholder="add tags"> 
                                                    @error('product_color_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_en" id="short_descp_en" class="form-control" rows="10">{{ $product->short_descp_en }}</textarea> 
                                                    @error('short_descp_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description VietNam <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_vn" id="short_descp_vn" class="form-control" rows="10">{{ $product->short_descp_vn }}</textarea> 
                                                    @error('short_descp_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Long Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="long_descp_en" id="editor1" rows="10" cols="80">{{ $product->long_descp_en }}</textarea> 
                                                    @error('long_descp_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Long Description VietNam <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="long_descp_vn" id="editor2" rows="10" cols="80">{{ $product->long_descp_vn }}</textarea> 
                                                    @error('long_descp_vn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals == 1 ? 'checked' : ''}}>
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $product->featured == 1 ? 'checked' : ''}}>
                                                <label for="checkbox_3">Featured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $product->special_offer == 1 ? 'checked' : ''}}>
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $product->special_deals == 1 ? 'checked' : ''}}>
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Multiple Image Update Area -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('product.image.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-sm">
                                @foreach ($multiImgs as $item)
                                <div class="col-md-3">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{ asset($item->photo_name) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('product.multiimage.delete', $item->id ) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fas fa-trash"></i></a>
                                            </h5>
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label class="form-control-label">Change Image <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control"  name="multi_img[{{ $item->id }}]" >
                                                </div>
                                            </p>
                                            <div class="form-group">
                                                <h5>Product Image Size <span class="text-danger">*</span></h5>
                                                <select name="image_size" id="image_size" class="form-control">
                                                    <option value="1200x800">1200 x 800</option>
                                                    <option value="917x1000">917 x 1000</option>
                                                    <option value="792x1056">792 x 1056</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                            </div>
                        </form>
                    </div>
				</div>
			  </div>
        </div>
    </section>
    <!-- Thumbnail Image Update  -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('product.thumbnail.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row row-sm">
                                <div class="col-md-6">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{ asset($product->product_thumbnail) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label class="form-control-label">Update Image <span class="text-danger">*</span></label>
                                                    <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control" onchange="mainThumbUrl(this)"> 

                                                    <div class="form-group">
                                                        <h5>Product Image Size <span class="text-danger">*</span></h5>
                                                        <select name="image_size" id="image_size" class="form-control">
                                                            <option value="1200x800">1200 x 800</option>
                                                            <option value="917x1000">917 x 1000</option>
                                                            <option value="792x1056">792 x 1056</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" id="mainThumb" >
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
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
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="subsubcategory_id"]').html(' ');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        // GetSubSubCategory
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });   

        $('#multiImg').on('change', function(){ 
            if (window.File && window.FileReader && window.FileList && window.Blob){
                var data = $(this)[0].files; 
                $.each(data, function(index, file){
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ 
                        var fRead = new FileReader();
                        fRead.onload = (function(file){ 
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80).height(80); 
                                $('#preview_img').append(img); 
                            };
                        })(file);
                        fRead.readAsDataURL(file); 
                    }
                });
            }else{
                alert("Your browser doesn't support File API!"); 
            }
        });    
    });

    function mainThumbUrl(input) {
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    } 

    

</script>