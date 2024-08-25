<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            "postTitle"=> $this->post_title,
            "postContent"=> $this->post_content,
            "postAuthor"=> $this->post_author,
            "time"=> $this->updated_at
        ];
    }
}
