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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start, // format for output
            'end' => $this->end, // format for output
            'created_at' => $this->created_at->format('d/m/Y'), // format for output
            'updated_at' => $this->updated_at->format('d/m/Y'), // format for output
        ];    
    }
}
