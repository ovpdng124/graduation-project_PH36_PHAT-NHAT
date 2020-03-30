<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Helpers\GlobalHelper;
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
    protected $messages;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->messages        = GlobalHelper::$messages;
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

        return redirect(route('category.index'))->with($this->messages['create_success']);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(EditCategoryRequest $request, $id)
    {
        $params = $request->except('_token');

        Category::find($id)->update($params);

        if (strpos($request->url(), 'detail')) {
            return redirect(route('category.show', $id))->with($this->messages['update_success']);
        }

        return redirect(route('category.index'))->with($this->messages['update_success']);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with($this->messages['delete_success']);
    }
}
