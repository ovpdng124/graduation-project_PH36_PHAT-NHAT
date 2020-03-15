<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\ProductAttributes;
use App\Entities\ProductImage;
use App\Filters\ProductFilter;

class ProductAttributeService
{
    protected $productFilter;

    public function __construct()
    {
        $this->productFilter = app(ProductFilter::class);
    }

    public function getProducts($limits, $search, $searchKey)
    {
        $query = ProductAttributes::query();

        if (!empty($searchKey) && !empty($search)) {
            $query = $this->productFilter->search($query, $search, $searchKey);
        }

        $query = $query->orderByDesc('created_at')->paginate($limits);

        return $query;
    }

    public function store($request)
    {
        $params           = $request->except('_token', 'thumbnails');
        $thumbnails       = $request->file('thumbnails');
        $productAttribute = ProductAttributes::create($params);

        return $this->storeThumbnails($thumbnails, $productAttribute->id, $productAttribute->product_id);

    }

    public function storeThumbnails($thumbnails, $id, $product_id)
    {
        $pathThumbnail = ProductImage::$paths['Thumbnail'] . $id . "/";
        $type          = ProductImage::$types['Thumbnail'];

        foreach ($thumbnails as $thumbnail) {

            $thumbnailsName             = $thumbnail->getClientOriginalName();
            $productAttributeThumbnails = [
                'product_id'           => $product_id,
                'product_attribute_id' => $id,
                'image_path'           => $pathThumbnail . $thumbnailsName,
                'image_type'           => $type,
            ];

            $thumbnail->move(public_path($pathThumbnail), $thumbnailsName);

            ProductImage::create($productAttributeThumbnails);
        }

        return true;
    }

    public function update($request, $id)
    {
        $params = $request->except('_token', 'thumbnails');

        if ($request->file('thumbnails')) {
            $thumbnails = $request->file('thumbnails');

            $this->updateThumbnails($thumbnails, $id);

        }

        return ProductAttributes::find($id)->update($params);
    }

    public function updateThumbnails($thumbnails, $id)
    {
        $productImages = ProductImage::where('product_attribute_id', $id)->where('image_type', ProductImage::$types['Thumbnail'])->get();

        foreach ($productImages as $productImage) {
            $product_id = $productImage->product_id;

            $productImage->delete();
        }

        $this->storeThumbnails($thumbnails, $id, $product_id);

        return true;
    }
}
