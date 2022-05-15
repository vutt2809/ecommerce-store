$(function(){
    $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, delete it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Deleted!',
                    'Your brand has been deleted.',
                    'success'
                    )
                
            }
        })
    })
})


// Pending -> Confirm Order
$(function(){
    $(document).on('click', '#confirmed_order', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure to Confirmed ?',
            text: "Once confirm, You will not able to pending again!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, change it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Confirm!',
                    'Confirm Changes.',
                    'success'
                    )
            }
        })
    })
})


// Confirm -> Processing Order
$(function(){
    $(document).on('click', '#processing_order', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure to Processing ?',
            text: "Once confirm, You will not able to confirm again!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, change it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Processing!',
                    'Processing Changes.',
                    'success'
                    )
            }
        })
    })
})


// Processing -> Picked Order
$(function(){
    $(document).on('click', '#picked_order', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure to Picked ?',
            text: "Once picked, You will not able to processing again!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, change it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Picked!',
                    'Picked Changes.',
                    'success'
                    )
            }
        })
    })
})



// Picked -> Shipped Order
$(function(){
    $(document).on('click', '#shipped_order', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure to Shipped ?',
            text: "Once shipped, You will not able to picked again!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, change it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Shipped!',
                    'Shipped Changes.',
                    'success'
                    )
            }
        })
    })
})


// Shipped -> Delivered Order
$(function(){
    $(document).on('click', '#delivered_order', function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure to Delivered ?',
            text: "Once delivered, You will not able to shipped again!",
            icon: 'warning',
            background: 'black',
            showCancelButton: true,
            confirmButtonColor: '#4837f7',
            cancelButtonColor: '#ef3737',
            confirmButtonText: 'Yes, change it!'
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                    'Delivered!',
                    'Delivered Changes.',
                    'success'
                    )
            }
        })
    })
})




