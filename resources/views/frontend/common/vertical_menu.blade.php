@php 
$categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>@if (session()->get('language') == 'vietnam') Thể loại @else Categories  @endif</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{$category->category_icon}}" aria-hidden="true"></i>
                @if (session()->get('language') == 'vietnam') {{$category->category_name_vn}} @else {{$category->category_name_en}} @endif
                </a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                                $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                            @endphp 

                            @foreach($subCategories as $subCategory)
                            <div class="col-sm-12 col-md-3">
                                <a href="{{url('subcategory/product/'.$subCategory->id.'/'.$subCategory->subcategory_slug_en )}}">
                                <h2 class="title">@if (session()->get('language') == 'vietnam') {{$subCategory->subcategory_name_vn}} @else {{$subCategory->subcategory_name_en}} @endif</h2>                                    
                                </a>
                                @php
                                    $subSubCategories = App\Models\SubSubCategory::where('subcategory_id', $subCategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                                @endphp 
                                @foreach($subSubCategories as $subSubCategory)
                                <ul class="links list-unstyled">
                                    <li><a href="{{url('subsubcategory/product/'.$subSubCategory->id.'/'.$subSubCategory->subsubcategory_slug_en )}}">@if (session()->get('language') == 'vietnam') {{$subSubCategory->subsubcategory_name_vn}} @else {{$subSubCategory->subsubcategory_name_en}} @endif</a></li>    
                                </ul>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </li>
            @endforeach
        </ul>
    </nav>
</div>