@extends('admin.admin_master')  

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Seo Setting Page </h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('seo.setting.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $seo->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Meta title  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="meta_title" name="meta_title" class="form-control" required="" value="{{ $seo->meta_title}}" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Meta author<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="meta_author" name="meta_author" class="form-control" required="" value="{{ $seo->meta_author}}" >
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <h5>Meta keyword<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" required="" value="{{ $seo->meta_keyword}}" >
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <h5>Meta description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="meta_description" id="meta_description" class="form-control">{{ $seo->meta_description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Google Analytics<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="google_analytics" id="google_analytics" class="form-control">{{ $seo->google_analytics}}</textarea>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    function updateLogoImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>