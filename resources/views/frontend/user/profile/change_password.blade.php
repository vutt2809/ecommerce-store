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
            @include('frontend.user.sidebar')
            <div class="col-md-1"></div>
            <div class="col-md-8">
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
