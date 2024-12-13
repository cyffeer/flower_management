<?php

// routes/api.php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route to get all tasks
Route::get('/tasks', function () {
    return Task::all();
});

// Route to create a new task
Route::post('/tasks', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $task = Task::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
    ]);

    return response()->json($task, 201);
});


