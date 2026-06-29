<?php
namespace App\Services;

use App\Models\productvariationattribute;

class ProductVariationAttributeServices {

    // Add Or Update Variations
    public function addAndUpdateVariation($product_variation_id, $data)
{
    foreach ($data as $attribute) {
        // Skip if attribute_id or attribute_variation_id is empty/null
        if (
            empty($attribute['attribute_id']) ||
            empty($attribute['attribute_variation_id'])
        ) {
            continue;
        }
        ProductVariationAttribute::updateOrCreate(
            [
                'product_variation_id' => $product_variation_id,
                'attribute_id' => $attribute['attribute_id'],
            ],
            [
                'attribute_variation_id' =>
                    $attribute['attribute_variation_id'],
            ]
        );
    }

    return true;
}


    // Delete Variation
    public function deleteVariationAttribute($product_variation_id){
        $deleteProductVariationAttribute=productvariationattribute::where('product_variation_id',$product_variation_id)->delete();
    }

    // get Variation
    public function getVariation($product_variation_id){
        $productVariationAttribute=productvariationattribute::where('product_variation_id',$product_variation_id)->get();
        return $productVariationAttribute;
    }
}