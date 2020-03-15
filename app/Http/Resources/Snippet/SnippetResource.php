<?php

namespace App\Http\Resources\Snippet;

use App\Http\Resources\User\PublicUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SnippetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title ?: '',
            'steps_count' => $this->steps->count(),
            'is_public' => (bool) $this->is_public,
            'updated_at' => $this->updated_at->toDateTimeString(),
            'steps' => [
                'data' => StepResource::collection($this->whenLoaded('steps'))
            ],
            'author' => [
                'data' => new PublicUserResource($this->user)
            ],
            'user' => [
                'data' => [
                    'owner' => $this->user_id === optional(auth()->user())->id
                ]
            ]
        ];
    }
}
