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
            @include('frontend.user.sidebar') 
            <div class="col-md-1"></div>
            <div class="col-md-8">
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
