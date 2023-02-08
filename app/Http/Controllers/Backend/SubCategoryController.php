<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Repositories\SubCategory\SubCategoryInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryInterface $subCategoryRepository) {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function allSubCategory() {
        $subCategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('backend.category.subcategory_view', compact('subCategories', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_vn' => 'required',
            'category_id' => 'required'
        ],[
            'subcategory_name_en.required' => 'SubCategory name English is required',
            'subcategory_name_vn.required' => 'SubCategory name VietNam is required',
            'subcategory_icon.required' => 'Parent category is required',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_vn' => $request->subcategory_name_vn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subcategory_name_vn)),
        ]);

        $notification = [
            'message' => 'SubCategory inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit ($id) {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('backend.category.subcategory_edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request){
        $subcategoryId = $request->id;

        SubCategory::findOrFail($subcategoryId)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_vn' => $request->subcategory_name_vn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subcategory_name_vn)),
        ]);

        $notification = [
            'message' => 'SubCategory updated successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function delete($id) {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'SubCategory deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function allSubSubCategory() {
        $subCategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();

        return view('backend.category.sub_subcategory_view', compact('subSubCategories', 'categories', 'subCategories'));
    }
 
    public function getSubCategory($categoryId) {
        $subcategory = SubCategory::where('category_id', $categoryId)->orderBy('subcategory_name_en', 'ASC')->get();

        return json_encode($subcategory);
    }

    public function getSubSubCategory($subcategory_id) {
        $subSubCategories = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        
        return json_encode($subSubCategories);
    }

    public function storeSubSubCategory(Request $request){
        $request->validate([
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_vn' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ],[
            'subsubcategory_name_en.required' => 'Sub-SubCategory name English is required',
            'subsubcategory_name_vn.required' => 'Sub-SubCategory name VietNam is required',
            'category_id.required' => 'Category is required',
            'subcategory_id.required' => 'Sub category is required',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_vn' => $request->subsubcategory_name_vn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_vn)),
        ]);

        $notification = [
            'message' => 'Sub-SubCategory inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function editSubSubCategory($id){
        $subSubCategory = SubSubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        return view('backend.category.sub_subcategory_edit', compact('subSubCategory', 'categories', 'subCategories'));
    }

    public function updateSubSubCategory (Request $request) {
        $subSubCategoryId = $request->id;

        SubSubCategory::findOrFail($subSubCategoryId)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_vn' => $request->subsubcategory_name_vn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_vn)),
        ]);

        $notification = [
            'message' => 'Sub-SubCategory updated successfully',
            'alert-type' => 'info'
        ];
        
        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function deleteSubSubCategory($id){
        SubSubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'Sub-SubCategory deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
