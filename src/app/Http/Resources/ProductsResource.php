<?php

namespace App\Http\Resources;

use App\Models\ProductAdditionalInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'external_code' => $this->external_code,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency_price' => $this->currency_price,
            'purchase_price' => $this->purchase_price,
            'currency_purchase_price' => $this->currency_purchase_price,
            'discount' => $this->discount,
            'uploads' => UploadsResource::collection($this->uploads),
            'additional_info' => new ProductsAdditionalInfoResource($this->additional_info)
        ];
    }
}
