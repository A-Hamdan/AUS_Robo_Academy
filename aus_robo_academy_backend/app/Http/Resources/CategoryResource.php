<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\UserCategory;

class CategoryResource extends JsonResource
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
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'from_age' => $this->from_age,
            'to_age' => $this->to_age,
            'image' => env('APP_URL') .$this->image,
            'status' => $this->is_active,
            'enabled' => $request->segment(2) == 'programs' ? $this->when(isset($this->enabled), $this->enabled) : true,
        ];
    }
}
