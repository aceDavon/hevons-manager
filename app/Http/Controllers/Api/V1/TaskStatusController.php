<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStatusRequest;
use App\Http\Resources\Api\V1\TaskStatusResource;
use App\Models\Status;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskStatusResource::collection([
            Status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        $request->validated($request->all());

        $status = Status::create([
            "title" => $request->title,
            "color" => $request->color
        ]);

        return new TaskStatusResource($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return new TaskStatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $status = $status->update($request->all());

        return new TaskStatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return $this->success([
            null,
            'Status deleted successfully...'
        ]);
    }
}
