<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(Request $request) {
        $data = $request->all();

        $request->validate([
            'category_name_en' => 'required',
            'category_name_vn' => 'required',
            'category_icon' => 'required'
        ],[
            'category_name_en.required' => 'Category name English is required',
            'category_name_vn.required' => 'Category name VietNam is required',
            'category_icon.required' => 'Category icon is required',
        ]);

        $data['category_slug_en'] = strtolower(str_replace(' ', '-', $request->category_name_en));
        $data['category_slug_vn'] = strtolower(str_replace(' ', '-', $request->category_name_vn));

        return $data;
    }

    public function allCategory() {
        $categories = $this->categoryRepository->getAll();
        return view('backend.category.category_view', compact('categories'));
    }

    public function store(Request $request) {
        $data = $this->handle($request);
        $this->categoryRepository->create($data);

        $notification = [
            'message' => 'Category inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id) {
        $category = $this->categoryRepository->find($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function update(Request $request) {
        $categoryId = $request->id;
        $data = $this->handle($request);
        $this->categoryRepository->update($categoryId, $data);

        $notification = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function delete($id){
        $this->categoryRepository->delete($id);

        $notification = [
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
