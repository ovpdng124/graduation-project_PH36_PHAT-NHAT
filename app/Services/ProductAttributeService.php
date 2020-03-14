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
        $params = $request->except('_token', 'avatar', 'thumbnails');

        if ($request->hasfile('avatar')) {
            $avatar           = $request->file('avatar');
            $productAttribute = ProductAttributes::create($params);

            if ($request->hasFile('thumbnails')) {
                $thumbnails = $request->file('thumbnails');

                $this->storeThumbnails($thumbnails, $productAttribute->id, $productAttribute->product_id);
            }

            return $this->storeAvatar($avatar, $productAttribute->id, $productAttribute->product_id);
        }

        return false;
    }

    public function storeAvatar($avatar, $id, $product_id)
    {
        $avatarName             = $avatar->getClientOriginalName();
        $pathAvatar             = ProductImage::$paths['Avatar'] . $id . "/";
        $type                   = ProductImage::$types;
        $productAttributeAvatar = [
            'product_id'           => $product_id,
            'product_attribute_id' => $id,
            'image_path'           => $pathAvatar . $avatarName,
            'image_type'           => $type['Avatar'],
        ];

        $avatar->move(public_path($pathAvatar), $avatarName);

        return ProductImage::create($productAttributeAvatar);
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
        $params = $request->except('_token', 'avatar', 'thumbnails');

        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar');

            $this->updateAvatar($avatar, $id);
        }

        if ($request->hasfile('thumbnails')) {
            $thumbnails = $request->file('thumbnails');

            $this->updateThumbnails($thumbnails, $id);
        }

        return ProductAttributes::find($id)->update($params);
    }


    public function updateAvatar($avatar, $id)
    {
        $avatarName             = $avatar->getClientOriginalName();
        $pathAvatar             = ProductImage::$paths['Avatar'] . $id . "/";
        $data['image_path']     = $pathAvatar . $avatarName;
        $productAttributeAvatar = ProductImage::where('product_attribute_id', $id)->where('image_type', ProductImage::$types['Avatar'])->first();

        $avatar->move(public_path($pathAvatar), $avatarName);

        return $productAttributeAvatar->update($data);
    }

    public function updateThumbnails($thumbnails, $id)
    {
        $pathThumbnail = ProductImage::$paths['Thumbnail'] . $id . "/";
        $productImages = ProductImage::where('product_attribute_id', $id)->where('image_type', ProductImage::$types['Thumbnail'])->get();
        $product_id    = '';

        foreach ($productImages as $productImage) {
            $product_id = $productImage->product_id;

            $productImage->delete();
        }

        foreach ($thumbnails as $thumbnail) {
            $thumbnailsName = $thumbnail->getClientOriginalName();
            $dataImages     = [
                'image_path'           => $pathThumbnail . $thumbnailsName,
                'image_type'           => ProductImage::$types['Thumbnail'],
                'product_attribute_id' => $id,
                'product_id'           => $product_id,
            ];

            $thumbnail->move(public_path($pathThumbnail), $thumbnailsName);

            ProductImage::create($dataImages);
        }

        return true;
    }
}
