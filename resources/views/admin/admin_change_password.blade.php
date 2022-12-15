@extends ('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Change Password</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('admin.update.password', $admin->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 offset-3">
                                    <div class="form-group">
                                        <h5>Current Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" id="current_password" name="oldpassword" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>New Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" id="password" name="password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Confirm Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Update">
                                    </div>
                                </div>
                            </div>			
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

