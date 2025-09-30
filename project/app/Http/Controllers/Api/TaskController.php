<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        /*$tasks = Task::all();*/
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return response()->json([
            'success' => true,
            'data'=>$tasks
        ], Response::HTTP_OK

        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        
        $validated = $request->validate([
            'tittle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $validated['user_id'] = $request->user()->id;
        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task created',
            'data' => $task
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ],Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ],Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validate([
            'tittle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Task updated',
            'data' => $task
        ],Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ],Response::HTTP_FORBIDDEN);
        }
        
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted'
        ],Response::HTTP_OK);

    }
}
