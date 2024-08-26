<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
            'id'=>$this->id,
            'commentPostId'=>$this->comment_post_id,
            'commentAuthor'=>$this->comment_author,
            'commentContent'=>$this->comment_content,
            'commentTime'=>$this->updated_at
        ];
    }
}
