<?php

namespace App\Http\Resources\Snippet;

use Illuminate\Http\Resources\Json\JsonResource;

class StepResource extends JsonResource
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
            'order' => $this->order,
            'title' => $this->title ?: '',
            'body' => $this->body ?: ''
        ];
    }
}
