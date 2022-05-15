<style>
    .list-profile li {
        margin: 10px 0;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .list-profile li:hover {
        border-radius: 4px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }

    .list-profile li a i {
        color: #157ed2;
    }

    .list-profile li a i {
        font-size: 18px;
        margin-right: 8px;
    }
</style>

<div class="col-md-2">
<img id="profile_image" style= "border-radius: 50%; width: 100%; margin: 24px 0;" src="{{ (!empty(Auth::user()->profile_photo_path)) ? url('upload/user_images/'.Auth::user()->profile_photo_path ) : url('upload/no_image.jpg') }}">


<!-- <ul class="list-group list-group-flush">
    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Home</a>
    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
    <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">Order</a>
    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
</ul> -->


<ul class="list-group list-group-flush list-profile">
    <li><a href="{{ route('user.profile') }}" class="btn"><i class="fas fa-home"></i><b>Home</b></a></li>
    <li><a href="{{ route('user.profile') }}" class="btn"><i class="fas fa-address-card"></i><b>Profile Update</b></a></li>
    <li><a href="{{ route('change.password') }}" class="btn"><i class="fas fa-key"></i><b>Change Password</b></a></li>
    <li><a href="{{ route('my.orders') }}" class="btn"><i class="fas fa-history"></i><b>Order</b></a></li>
    <li><a href="{{ route('my.orders.return') }}" class="btn"><i class="fas fa-history"></i><b>Return Order</b></a></li>
    <li><a href="{{ route('my.orders.cancel') }}" class="btn"><i class="fas fa-history"></i><b>Cancel Order</b></a></li>
    <li><a href="{{ route('user.logout') }}" class="btn"><i class="fas fa-sign-out"></i><b>Logout</b></a></li>
</ul>

</div>

