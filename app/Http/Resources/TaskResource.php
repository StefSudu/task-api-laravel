<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "type" =>  "task",
            "id" => $this->id,
            "attributes" => [
                "title" => $this->title,
                "description" => $this->description,
                "status" => $this->status
            ]
        ];
    }
}