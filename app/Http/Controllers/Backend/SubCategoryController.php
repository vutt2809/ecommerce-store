<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function allSubCategory() {
        $subcategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
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

        $notofication = [
            'message' => 'SubCategory inserted successfully',
            'alert-type' => 'success'
        ];

        
        return redirect()->back()->with($notofication);
    }

    public function edit ($id) {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request){
        $subcategory_id = $request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_vn' => $request->subcategory_name_vn,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subcategory_name_vn)),
        ]);

        $notofication = [
            'message' => 'SubCategory updated successfully',
            'alert-type' => 'info'
        ];

        
        return redirect()->route('all.subcategory')->with($notofication);

    }

    public function delete($id) {

        SubCategory::findOrFail($id)->delete();

        $notofication = [
            'message' => 'SubCategory deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notofication);

    }

    public function allSubSubCategory() {
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories', 'subcategories'));
    }
 
    public function getSubCategory($category_id) {
        $subcategory = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategory);
    }

    public function getSubSubCategory($subcategory_id) {
        $subsubcategories = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcategories);
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

        $notofication = [
            'message' => 'Sub-SubCategory inserted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notofication);
    }

    public function editSubSubCategory($id){
        $subsubcategory = SubSubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        return view('backend.category.sub_subcategory_edit', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function updateSubSubCategory (Request $request) {
        $subsubcategory_id = $request->id;

        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_vn' => $request->subsubcategory_name_vn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_vn' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_vn)),
        ]);

        $notofication = [
            'message' => 'Sub-SubCategory updated successfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('all.subsubcategory')->with($notofication);
    }

    public function deleteSubSubCategory($id){
        SubSubCategory::findOrFail($id)->delete();

        $notofication = [
            'message' => 'Sub-SubCategory deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notofication);
    }
}
