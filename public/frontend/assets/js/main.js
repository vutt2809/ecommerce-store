
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function preview(id) {
    $.ajax({
        type: 'GET',
        url: '/product/view/modal/' + id,
        dataType: 'json',
        success: function (data) {
            $('#p_name').text(data.product.product_name_en);
            $('#p_code').text(data.product.product_code);
            $('#p_category').text(data.product.category.category_name_en);
            $('#p_brand').text(data.product.brand.brand_name_en);
            $('#p_stock').text(data.product.product_qty);
            $('#p_image').attr('src', '/' + data.product.product_thumbnail);

            $('#product_id').val(id);
            $('#quantity').val(1);

            // check Product price
            if (data.product.discount_price == null) {
                $('#p_price').text('')
                $('#p_old_price').text('')
                $('#p_price').text(data.product.selling_price)
            } else {
                $('#p_price').text(data.product.discount_price)
                $('#p_old_price').text(data.product.selling_price)
            }

            // Color 
            $('select[name="color"]').empty()
            
            $.each(data.color, (key, value) => {
                $('select[name="color"]').append('<option value="' + value + '">' + value + '</option>',)
            })

            $('select[name="size"]').empty()

            $.each(data.size, (key, value) => {
                $('select[name="size"]').append('<option value="' + value + '">' + value + '</option>',)

                if (data.size == "") {
                    $('.size-area').hide();
                } else {
                    $('.size-area').show();
                }
            })

            if (data.product.product_qty > 0) {
                $('#available').text('')
                $('#stockout').text('')
                $('#available').text('Available')
            } else {
                $('#available').text('')
                $('#stockout').text('')
                $('#stockout').text('Stockout')
            }

        }
    })
}

function addToCart() {
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
        url: "/cart/data/store/" + id,
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

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    title: data.success
                })
            } else {
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
        success: (res) => {
            $('span[id="cart-quantity"]').text(res.cartQuantity);
            $('span[id="cart-subtotal"]').text(res.cartTotal);
            $('span[id="cart-total"]').text(res.cartTotal);

            var miniCart = "";
            $.each(res.carts, (key, val) => {
                console.log(val);

                miniCart +=
                    `<div class="cart-item product-summary">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="image"> <a href="{{ url('product/details/'.'${val.id}'.'/'.'${val.product_slug_en}') }}"><img src="/${val.attributes.image}" alt=""></a> </div>
                        </div>
                        <div class="col-xs-7">
                            <h4 class="name"><a href="{{ url('product/details/'.'${val.id}'.'/'.'${val.product_slug_en}') }}"">${val.name}</a></h4>
                            <div class="price">${val.price} * ${val.quantity} $</div>
                        </div>
                        <div class="col-xs-1 action"> 
                            <button type="submit" id="${val.id}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> 
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

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    title: data.success
                })
            } else {
                Toast.fire({
                    title: data.error
                })
            }
        }
    })
}

function addToWishlist(product_id) {
    $.ajax({
        type: 'POST',
        url: '/user/add-to-wishlist/' + product_id,
        dataType: 'json',
        success: (data) => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                })
            }
        }
    })
}

function wishlist() {
    $.ajax({
        type: 'GET',
        url: '/user/get-wishlist-product',
        dataType: 'json',
        success: (res) => {
            var rows = "";
            $.each(res, (key, val) => {
                rows +=
                    `<tr>
                    <td class="col-md-2"><img src="/${val.product.product_thumbnail}" alt="imga"></td>
                    <td class="col-md-7">
                        <div class="product-name"><a href="#">${val.product.product_name_en}</a></div>
                        <div class="rating">
                            <i class="fa fa-star rate"></i>
                            <i class="fa fa-star rate"></i>
                            <i class="fa fa-star rate"></i>
                            <i class="fa fa-star rate"></i>
                            <i class="fa fa-star non-rate"></i>
                            <span class="review">( 06 Reviews )</span>
                        </div>
                        
                        <div class="price">
                        ${val.product.discount_price == null
                        ? `${val.product.selling_price}`
                        :
                        `${val.product.discount_price} <span>${val.product.selling_price}</span>`
                    }
                        </div>
                    </td>
                    <td class="col-md-2">
                        <button class="btn btn-uper btn-primary icon" type="button" id="${val.product.id}" title="Add Cart" data-toggle="modal" data-target="#add-to-cart" onclick="preview(this.id)"> <i class="fa fa-shopping-cart"></i>  Add to cart </button>
                    </td>
                    <td class="col-md-1 close-btn">
                        <a href="#" class=""></a>
                        <button type="submit" class="btn btn-danger btn-sm btn-circle" id="${val.product.id}" onclick="removeWishlist(this.id)"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
                `;
            })
            $('#wishlist').html(rows);
        }
    })
}

function removeWishlist(id) {
    $.ajax({
        type: 'GET',
        url: '/user/wishlist-remove/' + id,
        dataType: 'json',
        success: (data) => {
            wishlist()
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',

                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                })
            }
        }
    })
}

function cart() {
    $.ajax({
        type: 'GET',
        url: '/user/get-cart-product',
        dataType: 'json',
        success: (res) => {
            var rows = "";
            $.each(res.carts, (key, val) => {
                console.log(val)
                rows +=
                    `<tr>
                    <td class="col-md-2"><img src="/${val.attributes.image}" alt="imga" style="width: 100%"></td>
                    <td class="col-md-4">
                        <div class="product-name"><a href="#">${val.name}</a></div>
                        <div class="price">${val.price}</div>
                    </td>
                    <td class="col-md-1"> 
                        ${val.attributes.color == null ? `<span> ... </span>` : `<strong>${val.attributes.color}</strong>`}
                    </td>
                    <td class="col-md-1"> 
                        ${val.attributes.size == null ? `<span> ... </span>` : `<strong>${val.attributes.size}</strong>`}
                    </td>
                    <td class="col-md-2"> 
                        ${val.quantity > 1
                        ? `<button type="submit" class="btn btn-danger btn-sm btn-circle" id="${val.id}" onclick="decreaseQuantity(this.id)">-</button>`
                        : `<button type="submit" class="btn btn-danger btn-sm btn-circle" disabled>-</button>`
                    }
                        
                        <input type="text" value="${val.quantity}" class="text-center" min="1" max="100" disabled="" style="width: 26px;">
                        <button type="submit" class="btn btn-success btn-sm btn-circle" id="${val.id}" onclick="increaseQuantity(this.id)">+</button>
                    </td>
                    <td class="col-md-1"> 
                        <strong>$${val.price * val.quantity}</strong>
                    </td>
                    <td class="col-md-1 close-btn">
                        <a href="#" class=""></a>
                        <button type="submit" class="btn btn-danger btn-sm btn-circle" id="${val.id}" onclick="removeProductFromCart(${val.id})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                `;
            })

            $('#my-cart').html(rows);
        }
    })
}

function removeProductFromCart(id) {
    console.log(id);
    $.ajax({
        type: 'GET',
        url: '/user/cart-remove/' + id,
        dataType: 'json',
        success: (data) => {
            couponCalculation()
            cart()
            miniCart()
            $('#couponField').show()
            $('#coupon_name').val('')
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',

                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                })
            }
        }
    })
}

function increaseQuantity(id) {
    $.ajax({
        type: 'GET',
        url: '/cart-increment/' + id,
        dataType: 'json',
        success: (data) => {
            couponCalculation()
            cart()
            miniCart()

        }
    })
}

function decreaseQuantity(id) {
    $.ajax({
        type: 'GET',
        url: '/cart-decrement/' + id,
        dataType: 'json',
        success: (data) => {
            couponCalculation();
            cart()
            miniCart()
        }
    })


}
// Run Function
cart();
miniCart();
wishlist();


// ===================== Coupon Apply =====================
function applyCoupon() {
    var coupon_name = $('#coupon_name').val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { coupon_name: coupon_name },
        url: "{{ url('/coupon-apply') }}",
        success: (data) => {
            couponCalculation()

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
                $('#couponField').hide();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                })
            }
        }
    })
}

function couponCalculation() {
    $.ajax({
        type: 'GET',
        url: "{{ url('/coupon-calculation') }}",
        dataType: 'json',
        success: (data) => {
            if (data.total) {
                $('#couponCalField').html(`
                <tr>
                    <th>
                        <div class="cart-sub-total">
                            Subtotal<span class="inner-left-md">$ ${data.total}</span>
                        </div>
                        <div class="cart-grand-total">
                            Grand Total<span class="inner-left-md">$ ${data.total}</span>
                        </div>
                    </th>
                </tr>
            `)
            } else {
                $('#couponCalField').html(`
                <tr>
                    <th>
                        <div class="cart-sub-total">
                            Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
                        </div>
                        <div class="cart-sub-total">
                            Coupon Name<span class="inner-left-md">${data.coupon_name}</span>
                            <button class="btn btn-warning btn-circle" onclick="removeCoupon()"><i class="fas fa-times"></i> </button>
                        </div>
                        <div class="cart-sub-total">
                            Discount Amount<span class="inner-left-md">$ ${data.discount_amount}</span>
                        </div>
                        <div class="cart-grand-total">
                            Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
                        </div>
                    </th>
                </tr>
            `)
            }
        }
    })
}

function removeCoupon() {
    $.ajax({
        type: 'GET',
        url: "{{ url('/coupon-remove') }}",
        dataType: 'json',
        success: (data) => {
            couponCalculation()
            $('#couponField').show();
            $('#coupon_name').val('');
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                })
            }
        }
    })
}
