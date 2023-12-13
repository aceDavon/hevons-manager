<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskPriorityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "data" => [
                "title" => $this->title,
                "color" => $this->color
            ],
            "relationships" => $this->when(
                $this->relationLoaded('task') && $this->task,
                [
                    "task" => [
                        "id" => $this->task->id ?? null,
                        "title" => $this->task->title ?? null,
                        "assignee" => $this->task->user->first_name ?? null
                    ]
                ]
            )
        ];
    }
}
