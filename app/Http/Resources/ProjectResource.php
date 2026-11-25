<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'summary' => $this->short_description,
            'thumbnail' => $this->thumbnail
                ? asset('storage/' . $this->thumbnail)
                : null,
            'category' => $this->category?->name,
            'skills' => $this->skills->pluck('name'),
        ];
    }
}
