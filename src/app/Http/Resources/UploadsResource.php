<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UploadsResource extends JsonResource
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
            'disk' => $this->disk,
            'name' => $this->name,
            'path' => asset($this->path),
            'size' => $this->size,
            'hash' => $this->hash,
            'upload_type' => $this->upload_type ?? null
        ];
    }
}
