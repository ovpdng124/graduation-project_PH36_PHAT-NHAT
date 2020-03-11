<?php

namespace App\Services;

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
        $params = $request->except('_token', 'avatar', 'thumbnail');

        if ($request->hasfile('avatar', 'thumbnail')) {
            $images = $request->file('avatar', 'thumbnail');

            $productAttribute = ProductAttributes::create($params);

            return $this->storeImages($images, $productAttribute->id, $productAttribute->product_id);
        }

        return false;
    }

    public function storeImages($images, $id, $product_id)
    {
        $imagesName    = $images->getClientOriginalName();
        $pathAvatar    = ProductImage::$paths['Avatar'] . $id . "/";
        $pathThumbnail = ProductImage::$paths['Thumbnail'] . $id . "/";
        $type          = ProductImage::$types;

        $images->move(public_path($pathAvatar, $pathThumbnail), $imagesName);

        $productAttributeImages = [
            'product_id'           => $product_id,
            'product_attribute_id' => $id,
            'image_path'           => $pathAvatar . $imagesName,
            'image_type'           => $type['Avatar'],
        ];
        return ProductImage::create($productAttributeImages);
    }

    public function update($request, $id)
    {
        $params = $request->except('_token', 'avatar', 'thumbnail');

        if ($request->hasfile('avatar', 'thumbnail')) {

            $images = $request->file('avatar', 'thumbnail');

            $this->updateImages($images, $id);
        }

        return ProductAttributes::find($id)->update($params);
    }

    public function updateImages($images, $id)
    {
        $imagesName         = $images->getClientOriginalName();
        $pathAvatar         = ProductImage::$paths['Avatar'] . $id . "/";
        $pathThumbnail      = ProductImage::$paths['Thumbnail'] . $id . "/";
        $data['image_path'] = $pathAvatar . $imagesName;

        $images->move(public_path($pathAvatar, $pathThumbnail), $imagesName);

        $productAttributeImages = ProductImage::where('product_attribute_id', $id)->first();

        return $productAttributeImages->update($data);
    }
}
