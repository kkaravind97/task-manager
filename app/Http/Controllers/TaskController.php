<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task created succesfully !!');
    }

    public function show(Task $task) {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully !!');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully !!');
    }
}
