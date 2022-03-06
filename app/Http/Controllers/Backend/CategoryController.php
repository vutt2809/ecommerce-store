<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory() {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_vn' => 'required',
            'category_icon' => 'required'
        ],[
            'category_name_en.required' => 'Category name English is required',
            'category_name_vn.required' => 'Category name VietNam is required',
            'category_icon.required' => 'Category icon is required',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_vn' => strtolower(str_replace(' ', '-', $request->category_name_vn)),
            'category_icon' => $request->category_icon
        ]);

        $notofication = [
            'message' => 'Category inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notofication);
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function update(Request $request) {
        $category_id = $request->id;
        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_vn' => $request->category_name_vn,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_vn' => strtolower(str_replace(' ', '-', $request->category_name_vn)),
            'category_icon' => $request->category_icon
        ]);

        $notofication = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notofication);
    }

    public function delete($id){
        Category::findOrFail($id)->delete();

        $notofication = [
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notofication);
    }
}
