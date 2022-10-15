@extends('admin.admin_master')  

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Site Setting Page </h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Site logo  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="logo" name="logo" class="form-control" required="" >
                                        </div>

                                        <img src="" id="logo_thumb" alt="">
                                    </div> 

                                    <div class="form-group">
                                        <h5>Phone One  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="phone_one" name="phone_one" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Phone Two  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="phone_two" name="phone_two" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Email  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" id="email" name="email" class="form-control" required="" >
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <h5>Company Address  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="company_address" name="company_address" class="form-control" required="" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Company Address  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="company_address" name="company_address" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Facebook  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="facebook" name="facebook" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Twitter  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="twitter" name="twitter" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Linkedin  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="linkedin" name="linkedin" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Youtube  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="youtube" name="youtube" class="form-control" required="" >
                                        </div>
                                    </div> 

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">					 
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