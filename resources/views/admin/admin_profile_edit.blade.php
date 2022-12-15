@extends ('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Profile Edit</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('admin.profile.store', $admin->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">		
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin User Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required="" value="{{ $admin->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin Email<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" required="" value="{{ $admin->email }}" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>	
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" id="image" name="profile_photo_path" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <img id="profile-image"  src="{{ (!empty($admin->profile_photo_path)) ? url('upload/admin_images/'.$admin->profile_photo_path ) : url('upload/no_image.jpg') }}" style="width: 100px; height: 100px" alt="">
                                        </div>

                                    </div>			
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

    $(document).ready(function () {
        $('#image').change(function(e) {
            let reader = new FileReader()

            reader.onload = function (e) {
                $('#profile-image').attr('src', e.target.result)
            }

            reader.readAsDataURL (e.target.files['0'])
        });
    });

</script>
@endsection

