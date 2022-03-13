@extends('frontend.main_master')

@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Account</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img id="profile_image" style= "border-radius: 50%; width: 100%; margin: 24px 0;" src="{{ (!empty(Auth::user()->profile_photo_path)) ? url('upload/user_images/'.Auth::user()->profile_photo_path ) : url('upload/no_image.jpg') }}">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div> 
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="card">
                 </div>
                <div class="card-body">
                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" id="oldpassword" name="oldpassword" class="form-control unicase-form-control text-input">
                        </div>
                        <div class="form-group">
                            <label for="">New Password <span>*</span></label>
                            <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password <span>*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" >Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
