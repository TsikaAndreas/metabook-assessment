<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShelfResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'books' => $this->when($this->relationLoaded('books'), function () {
                return BookResource::collection($this->books()->paginate(10))->response()->getData(true);
            }),
        ];
    }
}
