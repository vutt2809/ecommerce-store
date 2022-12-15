@extends ('admin.admin_master')

@section('admin')

<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Profile</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Extra</li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
	</div>
	<section class="content">
        <div class="row">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                    <h3 class="widget-user-username">Admin Name: {{ $admin->name }}</h3>
                    <a href="{{ route('admin.profile.edit', $admin->id) }}" class="btn btn-rounded btn-success mb-5" style="float: right;">Edit Profile</a>
                    <h6 class="widget-user-desc">Admin Email: {{ $admin->email }}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="rounded-circle" src="{{ (!empty($admin->profile_photo_path)) ? url('upload/admin_images/'.$admin->profile_photo_path) : url('upload/no_image.jpg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">12K</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                        </div>
                        <div class="col-sm-4 br-1 bl-1">
                            <div class="description-block">
                            <h5 class="description-header">550</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">158</h5>
                            <span class="description-text">TWEETS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection