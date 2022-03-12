<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <!-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>
<body class="cnt-home">

    @include('frontend.body.header')

    @yield('content')

    @include('frontend.body.footer')


    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script> 
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

    <!-- =============== Modal =============== -->
    <div class="modal fade" id="add-to-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span id="p_name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="" id="p_image" width="100%" style="margin-top: 20px;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="p_price"></span></strong> <del id="p_old_price">$</del></li>
                            <li class="list-group-item">Product Code: <strong id="p_code"></strong></li>
                            <li class="list-group-item">Category:  <strong id="p_category"></strong></li>
                            <li class="list-group-item">Brand:  <strong id="p_brand"></strong></li>
                            <li class="list-group-item">Stock: 
                                <span class="badge badge-pill badge-success" id="available" style="background: green;"></span> 
                                <span class="badge badge-pill badge-danger" id="stockout" style="background: red;"></span> 
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group color-area">
                            <label for="color">Choose Color</label>
                            <select class="form-control" id="color" name="color">
                                <option>----Select Color----</option>
                            </select>
                        </div>
                        <div class="form-group size-area">
                            <label for="size">Choose Size</label>
                            <select class="form-control" id="size" name="size">
                                <option>----Select Size----</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="product_id" >
                <button type="button" class="btn btn-primary" onclick="addToCart()">Add To Cart</button>
            </div>
            </div>
        </div>
    </div>
    <!-- =============== End Modal =============== -->

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })

        // Start Product View Modal
        function preview(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json', 
                success: function (data){
                    $('#p_name').text(data.product.product_name_en);
                    $('#p_code').text(data.product.product_code);
                    $('#p_category').text(data.product.category.category_name_en);
                    $('#p_brand').text(data.product.brand.brand_name_en);
                    $('#p_stock').text(data.product.product_qty);
                    $('#p_image').attr('src', '/' + data.product.product_thumbnail);

                    $('#product_id').val(id);
                    $('#quantity').val(1);

                    // check Product price
                    if (data.product.discount_price == null){
                        $('#p_price').text('')
                        $('#p_old_price').text('')
                        $('#p_price').text(data.product.selling_price)
                    }else{
                        $('#p_price').text(data.product.discount_price)
                        $('#p_old_price').text(data.product.selling_price)
                    }

                    // Color 
                    $('select[name="color"]').empty()
                    $.each(data.color, (key, value) => {
                        $('select[name="color"]').append('<option value="'+ value +'">'+ value +'</option>', )
                    }) 

                    $('select[name="size"]').empty()
                    $.each(data.size, (key, value) => {
                        $('select[name="size"]').append('<option value="'+ value +'">'+ value +'</option>', )

                        if (data.size == ""){
                            $('.size-area').hide();
                        }else{
                            $('.size-area').show();
                        }
                    }) 

                    if (data.product.product_qty > 0){
                        $('#available').text('') 
                        $('#stockout').text('') 
                        $('#available').text('Available') 
                    }else{
                        $('#available').text('') 
                        $('#stockout').text('') 
                        $('#stockout').text('Stockout')
                    }

                }
            })
        }

        // Add To Cart
        function addToCart(){
            var product_name = $('#p_name').text()
            var id = $('#product_id').val()
            var color = $('#color option:selected').text()
            var size = $('#size option:selected').text()
            var quantity = $('#quantity').val()

            $.ajax({
                type: "POST",
                dataType: "json", 
                data: {
                    color: color, size: size, quantity: quantity, product_name: product_name
                },
                url: "/cart/data/store/"+id,
                success: (data) => {
                    miniCart();
                    $('#closeModal').click()

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    if ($.isEmptyObject(data.error)){
                        Toast.fire({
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            title: data.error
                        })
                    }
                }
            })
        } 

        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success : (res) => {
                    $('span[id="cart-quantity"]').text(res.cartQuantity);
                    $('span[id="cart-subtotal"]').text(res.cartTotal.amount);
                    $('span[id="cart-total"]').text(res.cartTotal.amount);

                    var miniCart = "";
                    $.each(res.carts, (key, val) => {
                        miniCart += 
                        `<div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image"> <a href="{{ url('product/details/'.'${val.id}'.'/'.'${val.product_slug_en}') }}"><img src="/${val.options.image}" alt=""></a> </div>
                                </div>
                                <div class="col-xs-7">
                                    <h4 class="name"><a href="{{ url('product/details/'.'${val.id}'.'/'.'${val.product_slug_en}') }}"">${val.name}</a></h4>
                                    <div class="price">${val.price} * ${val.qty} $</div>
                                </div>
                                <div class="col-xs-1 action"> 
                                    <button type="submit" id="${val.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> 
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        `;
                    })
                    $('#miniCart').html(miniCart);
                }
            })
        }

        function miniCartRemove(rowdId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowdId,
                dataType: 'json',
                success: (data) => {
                    miniCart()

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    if ($.isEmptyObject(data.error)){
                        Toast.fire({
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            title: data.error
                        })
                    }
                }

            })
        }


        miniCart();

    </script>
</body>
</html>

