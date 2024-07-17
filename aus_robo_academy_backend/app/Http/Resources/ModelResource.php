<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
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
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'passcode' => $this->passcode,
            'total_steps' => \App\Models\ModelStep::where('model_id',$this->id)->count(),
            'featured_image' => env('APP_URL') .$this->image,
            'Status' => $this->is_active,
            'enabled' => $request->segment(2) == 'models' ? $this->when(isset($this->enabled), $this->enabled) : true,

        ];
    }
}
