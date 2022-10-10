@section('title')
    {{ $blog->post_title_en }}
@endsection

@extends('frontend.main_master')

@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
                <li class='active'>@if (session()->get('language') == 'vietnam') {{ $blog->post_title_en }} @else {{ $blog->post_title_vn }} @endif</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
					<div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ asset($blog->post_image )}}" alt="">
                        <h1>{{ $blog->post_title_en }}</h1>
                        <span class="date-time">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans()  }}</span>
                        <p>{!! $blog->post_details_en !!}</p>
                        <div class="social-media">
                            <span>share post:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href=""><i class="fa fa-rss"></i></a>
                            <a href="" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>

                    <div class="blog-write-comment outer-bottom-xs outer-top-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Leave A Comment</h4>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                                </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                                </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="">
                                </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                                    <textarea class="form-control unicase-form-control" id="exampleInputComments" ></textarea>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-12 outer-bottom-small m-t-20">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-3 sidebar">
                    <div class="sidebar-module-container">
						<div class="search-area outer-bottom-small">
                        <form>
                            <div class="control-group">
                                <input placeholder="Type to search" class="search-field">
                                <a href="#" class="search-button"></a>   
                            </div>
                        </form>
                    </div>		

                    <div class="home-banner outer-top-n outer-bottom-xs">
                        <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div>
				    <!-- ==============================================CATEGORY============================================== -->
                    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                        <h3 class="section-title">Category</h3>
                        <div class="sidebar-widget-body m-t-10">
                            <div class="accordion">
                                @foreach ($blogCategories as $category) 
                                <ul class="list-group">
                                    <a href="{{ url('blog/category/post/' . $category->id) }}">
                                        <li class="list-group-item">@if(session()->get('language') == 'vietnam') {{ $category->blog_category_name_hin }} @else {{ $category->blog_category_name_en }} @endif</li>   
                                    </a>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection