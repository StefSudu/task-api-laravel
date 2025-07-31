<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplaceTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return TaskResource::collection(QueryBuilder::for(Task::class)->allowedFilters(['status'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $model = [
            "title" => $request->input('data.attributes.title'),
            "description" => $request->input('data.attributes.description'),
            "status" => $request->input('data.attributes.status'),
        ];

        return new TaskResource(Task::create($model));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }
    
        return response()->json([
            "message" => "Task found",
            "data" => new TaskResource($task)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        // PATCH
        try {
            $task = Task::findOrFail($id);
            
            $model = [
                "title" => $request->input('data.attributes.title'),
                "description" => $request->input('data.attributes.description'),
                "status" => $request->input('data.attributes.status'),
            ];

            $task->update($model);

            return response()->json([
                "message" => "Task updated",
                "data" => new TaskResource($task)
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function replace(ReplaceTaskRequest $request, string $id)
    {
        // PUT
        try {
            $task = Task::findOrFail($id);
            
            $model = [
                "title" => $request->input('data.attributes.title'),
                "description" => $request->input('data.attributes.description'),
                "status" => $request->input('data.attributes.status'),
            ];

            $task->update($model);

            return response()->json([
                "message" => "Task updated",
                "data" => new TaskResource($task)
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json([
                "message" => "Deleted task"
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message" => "Could not find task"
            ], 404);
        };
    }
}
