<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => $this->image, // Assuming you have an 'image' attribute in your article model
            'user' => new UserResource($this->user), // Use a UserResource to format the user data
            'comments' => CommentResource::collection($this->comments), // Use a CommentResource to format the comments
        ];
    }
}
