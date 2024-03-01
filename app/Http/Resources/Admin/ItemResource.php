<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'category' => $this->category_id,
            'item_name' => $this->item_name,
            'qty_available' => $this->qty_available,
            'is_in_stock' => $this->is_in_stock,
            'item_description' => $this->item_description,
            'price_item' => $this->price_item,
            'item_image' => ItemImageResource::collection($this->getMedia('images')), 
        ];
    }
}
