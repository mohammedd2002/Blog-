<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'message' => $this->message,
            'blogName' => $this->blog->name,
            'blogName' => new BlogResource($this->blog),
        ];
    }
}
