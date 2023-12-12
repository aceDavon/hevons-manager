<?php

namespace App\Http\Resources\Api\V1;

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
            'id' => (string)$this->id,
            'data' => [
                'title' => $this->title,
                'description' => $this->description
            ],
            'relationships' => [
                'id' => $this->user->id,
                'assignee_name' => $this->user->first_name,
                'assignee_email' => $this->user->email
            ]
        ];
    }
}
