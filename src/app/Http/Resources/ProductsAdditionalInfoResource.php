<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsAdditionalInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'size' => $this->size,
            'colour' => $this->colour,
            'brand' => $this->brand,
            'structure' => $this->structure,
            'amount_package' => $this->amount_package,
            'seo_title' => $this->seo_title,
            'seo_h1' => $this->seo_h1,
            'seo_description' => $this->seo_description,
            'weight_product_g' => $this->weight_product_g,
            'width_product_mm' => $this->width_product_mm,
            'height_product_mm' => $this->height_product_mm,
            'length_product_mm' => $this->length_product_mm,
            'weight_package_g' => $this->weight_package_g,
            'width_package_mm' => $this->width_package_mm,
            'height_package_mm' => $this->height_package_mm,
            'length_package_mm' => $this->length_package_mm,
            'category' => $this->category,
        ];
    }
}
