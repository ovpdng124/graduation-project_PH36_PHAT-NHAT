<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\ProductAttribute;
use App\Entities\ProductImage;
use App\Entities\Role;
use App\Entities\User;
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

        foreach ($products as $product) {
            $product->is_new = true;

            if (GlobalHelper::checkExpiredDate($product->updated_at, 7)) {
                $product->is_new = false;
            }
        }

        return $chunk->merge($products)->forPage(1, 9);
    }

    public function getPopularProducts($productAttributes)
    {
        $productAttributes = $productAttributes->sortByDesc('order_products_count')->take(3);
        $popularProduct    = [];
        $count             = 1;

        foreach ($productAttributes as $product) {
            $image_path                         = $product->product_images->first()->image_path;
            $popularProduct["product" . $count] = $product->id;
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

    public function getProductCart($params)
    {
        $productAttributes = ProductAttribute::with('product_images')->get();

        $arr         = [];
        $total_price = [];

        foreach ($params as $product) {
            $productAttribute              = $productAttributes->where('product_id', $product['product_id'])->where('color', "#" . $product['color'])->first();
            $productAttribute->quantity    = $product['quantity'];
            $productAttribute->total_price = $productAttribute['sub_price'] * $product['quantity'];
            $arr[]                         = $productAttribute;
            $total_price[]                 = $productAttribute->total_price;
        }

        return [
            'products' => $arr,
            'total'    => array_sum($total_price),
        ];
    }
}
