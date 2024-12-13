<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return Task::all();
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        return Task::create($request->all());
    }

    // Show a specific task
    public function show(Task $task)
    {
        return $task;
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task->update($request->all());

        return $task;
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
