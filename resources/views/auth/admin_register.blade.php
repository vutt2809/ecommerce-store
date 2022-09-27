<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>Ecommerce Admin - Login</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
     
  </head>
<body class="hold-transition theme-primary bg-gradient-light">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top-agile p-10">
							<h1 class="text-dark">Administrator</h1>
							<h2 class="text-dark">Get started with Us</h2>
							<p class="text-dark-50">Sign in to start your session</p>							
						</div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
							@if (Session::has('message'))
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>{{ Session::get('message') }}</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@endif
							<form method="POST" action="{{ route('admin.register.create') }}">
            					@csrf
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-dark"><i class="ti-user"></i></span>
										</div>
										<input type="text" id="name" name="name" class="form-control pl-15 bg-transparent text-dark plc-white" placeholder="User Name">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-dark"><i class="ti-info"></i></span>
										</div>
										<input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-dark plc-white" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-dark"><i class="ti-lock"></i></span>
										</div>
										<input type="password" id="password" name="password" class="form-control pl-15 bg-transparent text-dark plc-white" placeholder="Password">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-dark"><i class="ti-lock"></i></span>
										</div>
										<input type="password" id="password_confirmation" name="password_confirmation" class="form-control pl-15 bg-transparent text-dark plc-white" placeholder="Confirm Password">
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="checkbox text-dark">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Remember Me</label>
										</div>
									</div>
									<!-- /.col -->
									<div class="col-6">
										<div class="fog-pwd text-right">
											<a href="{{ route('password.request') }}" class="text-dark hover-info"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
										</div>
									</div>
									<!-- /.col -->
									<div class="col-12 text-center">
									  	<button type="submit" class="btn btn-info btn-rounded mt-10">SIGN UP</button>
									</div>
									<!-- /.col -->
								  </div>
							</form>														

							<div class="text-center text-dark">
							  <p class="mt-20">- Sign With -</p>
							  <p class="gap-items-2 mb-20">
								  <a class="btn btn-social-icon btn-round btn-outline btn-dark" href="#"><i class="fa fa-facebook"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-dark" href="#"><i class="fa fa-twitter"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-dark" href="#"><i class="fa fa-google-plus"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-dark" href="#"><i class="fa fa-instagram"></i></a>
								</p>	
							</div>
							
							<div class="text-center">
								<p class="mt-15 mb-0 text-dark">Don't have an account? <a href="{{ route('admin.register') }}" class="text-info ml-5">Sign Up</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>		

</body>
</html>
