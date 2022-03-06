@extends('frontend.main_master')

@section('content')

<style>
    .list-item{
        padding: 8px 0; 
        font-size: 16px; 
        cursor:pointer;
        color: black;
        border-bottom: 1px solid;
    }

    .list-item:hover {
        opacity: 0.9;
    }

    .list-item i{
        font-size: 26px;
        color: #0f6cb2;
        margin-right: 8px;
    }
</style>
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Account</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img id="profile_image" class="text-center" style= "border-radius: 50%; width: 80%; margin: 24px 0;" src="{{ (!empty(Auth::user()->profile_photo_path)) ? url('upload/user_images/'.Auth::user()->profile_photo_path ) : url('upload/no_image.jpg') }}">
                    <div class="card-body">
                        <h2 class="card-title text-center">{{ Auth::user()->name }}</h2>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-item"><i class="fa fa-home"></i><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="list-item"><i class="fa fa-edit"></i><a href="{{ route('user.profile') }}">Profile Update</a></li>
                        <li class="list-item"><i class="fa fa-key"></i><a href="{{ route('change.password') }}">Change Password</a></li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link"><a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a></a>
                    </div>
                </div>
            </div> 
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong> {{ Auth::user()->name }}</strong> Welcome To <strong>Vutt</strong> Learning</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control unicase-form-control text-input" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email Address <span>*</span></label>
                            <input type="email" name="email" class="form-control unicase-form-control text-input" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number <span>*</span></label>
                            <input type="text" name="phone" class="form-control unicase-form-control text-input" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="">User Image <span>*</span></label>
                            <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control unicase-form-control text-input">
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
