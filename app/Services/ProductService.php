<?php

namespace App\Services;

use App\Entities\Category;
use App\Entities\Product;
use App\Entities\ProductAttribute;
use App\Entities\ProductImage;
use App\Filters\ProductFilter;
use App\Helpers\GlobalHelper;

class ProductService
{
    /**
     * @var ProductFilter
     */
    protected $productFilter;

    public function __construct()
    {
        $this->productFilter = app(ProductFilter::class);
    }

    public function getProducts($limits, $search, $searchKey)
    {
        $query = Product::query();

        if (!empty($searchKey) && !empty($search)) {
            $query = $this->productFilter->search($query, $search, $searchKey);
        }

        $query = $query->with('category', 'product_images')->orderByDesc('updated_at')->paginate($limits);

        return $query;
    }

    public function store($params, $avatar)
    {
        $product = Product::create($params);

        return $this->storeAvatar($avatar, $product->id);
    }

    public function storeAvatar($avatar, $id)
    {
        $avatarName = $avatar->getClientOriginalName();
        $path       = ProductImage::$paths['Avatar'] . $id . '/';
        $type       = ProductImage::$types['Avatar'];

        $avatar->move(public_path($path), $avatarName);

        $productAvatar = [
            'product_id' => $id,
            'image_path' => $path . $avatarName,
            'image_type' => $type,
        ];

        return ProductImage::create($productAvatar);
    }

    public function update($params, $id, $avatar)
    {
        if (!empty($avatar)) {
            $this->updateAvatar($avatar, $id);
        }

        return Product::find($id)->update($params);
    }

    public function updateAvatar($avatar, $id)
    {
        $avatarName         = $avatar->getClientOriginalName();
        $path               = ProductImage::$paths['Avatar'] . $id . '/';
        $data['image_path'] = $path . $avatarName;

        $avatar->move(public_path($path), $avatarName);

        $product_image = ProductImage::where('product_id', $id)->first();

        return $product_image->update($data);
    }

    public function getNewArrivals($products)
    {
        $chunk = $products->splice(0, 9);

        $newProducts = $this->checkNewProducts($products);

        return $chunk->merge($newProducts)->forPage(1, 9);
    }

    public function checkNewProducts($products)
    {
        foreach ($products as $product) {
            $product->is_new = true;

            if (GlobalHelper::checkExpiredDate($product->updated_at, 7)) {
                $product->is_new = false;
            }
        }

        return $products;
    }

    public function getPopularProducts($productAttributes)
    {
        $productAttributes = $productAttributes->sortByDesc('order_products_count')->take(3);
        $popularProduct    = [];
        $count             = 1;

        foreach ($productAttributes as $product) {
            $image_path                         = $product->product_images->first()->image_path;
            $popularProduct["product" . $count] = $product->product_id;
            $popularProduct["image" . $count]   = $image_path;

            $count++;
        }

        return $popularProduct;
    }

    public function getDetailProduct($id, $products)
    {
        $product          = $products->where('id', $id)->first();
        $productImages    = $product->product_images->where('product_id', $id);
        $featuredProducts = $product->where('category_id', $product->category_id)->get();

        return [
            'product'          => $product,
            'productImages'    => $productImages,
            'featuredProducts' => $featuredProducts,
        ];
    }

    public function getCartProducts($params)
    {
        $productAttributes = ProductAttribute::with('product_images')->get();

        $products = $this->getProductAttributeCart($params, $productAttributes);

        $totalPriceCart = $productAttributes->sum('total_price');
        $totalQuantity  = $productAttributes->sum('quantity');

        return [
            'products'       => $products,
            'total_price'    => $totalPriceCart,
            'total_quantity' => $totalQuantity,
        ];
    }

    public function getProductAttributeCart($params, $collection)
    {
        $productAttributes = [];

        foreach ($params as $param) {
            $productAttribute = $collection->where('product_id', $param['product_id'])->where('color', "#" . $param['color'])->first();

            if (empty($productAttribute)) {
                $productAttributes = [];
                break;
            }

            $productAttribute->quantity    = $param['quantity'];
            $productAttribute->image_path  = $productAttribute->product_images->first()->image_path;
            $productAttribute->total_price = $productAttribute->quantity * $productAttribute->sub_price;

            $productAttributes[] = $productAttribute;
        }

        return $productAttributes;
    }

    public function getShoppingProducts($category)
    {
        $categories = Category::all();
        $query      = Product::query();

        if (!empty($category)) {
            $query = $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        $products = $query->with('product_images')->orderByDesc('updated_at')->paginate(9);

        $products = $this->checkNewProducts($products);

        return [
            'categories' => $categories,
            'products'   => $products,
        ];
    }
}
