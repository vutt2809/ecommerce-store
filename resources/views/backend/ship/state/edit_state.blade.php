@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit State</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('state.update', $state->id ) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="division_id" id="division_id" class="form-control">
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $state->division_id == $division->id ? 'selected' : ''}}>{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="district_id" id="district_id" class="form-control">
                                        @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $state->district_id == $district->id ? 'selected' : ''}}>{{ $district->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>State Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" id="state_name" name="state_name" class="form-control" value="{{ $state->state_name }}">
                                </div>
                                @error('state_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="btn btn-rounded btn-info" value="Update">
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
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/shipping/state/get-district') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d =$('select[name="district_id"]').empty();
                        console.log(data);
                        $.each(data, function(key, value){
                            console.log(value.district_name);
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });

</script>