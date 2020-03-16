<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }

    public function index(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $categories = $this->categoryService->getCategories($limits, $search, $searchKey);

        return view('admin.categories.list', compact('categories'));
    }

    public function show($id)
    {
        $category     = Category::with('products')->find($id);
        $products     = $category->products->sortByDesc('updated_at');
        $categoryData = [
            'products' => $products,
            'category' => $category,
        ];

        return view('admin.categories.detail', $categoryData);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $params = $request->except('_token');

        Category::create($params);

        return redirect(route('category.index'))->with('success', 'Created Successfully!');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(EditCategoryRequest $request, $id)
    {
        $params = $request->except('_token', 'url');

        Category::find($id)->update($params);

        return redirect($request->get('url'))->with('success', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
