<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelStepResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'featured_image' => env('APP_URL'). $this->image,
            'material_file' => env('APP_URL'). $this->mtl,
            'object_file' => env('APP_URL'). $this->obj,
            'is_3d_active' => $this->is_active
        ];
    }
}
