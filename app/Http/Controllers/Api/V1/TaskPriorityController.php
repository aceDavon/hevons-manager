<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePriorityRequest;
use App\Http\Resources\Api\V1\TaskPriorityResource;
use App\Models\Priority;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class TaskPriorityController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskPriorityResource::collection([
            Priority::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriorityRequest $request)
    {
        $request->validated($request->all());

        $priority = Priority::create([
            "title" => $request->title,
            "color" => $request->color
        ]);

        return $this->success([
            "data" => $priority,
            "message" => 'Priority created successfully...',
            "code" => 201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        return new TaskPriorityResource($priority);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Priority $priority)
    {
        $priority->update($request->all());

        return new TaskPriorityResource($priority);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        $priority->delete();

        return $this->success([
            null,
            "Priority deleted successfully..."
        ]);
    }
}
