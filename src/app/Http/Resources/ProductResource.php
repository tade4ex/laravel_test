<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sku' => $this->resource->sku,
            'description' => $this->resource->sku,
            'size' => $this->resource->sku,
            'photo' => $this->resource->sku,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'stocks' => StockResource::collection($this->whenLoaded('stocks')),
            'updated_at' => $this->resource->sku,
        ];
    }
}
