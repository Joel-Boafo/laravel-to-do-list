<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255',
        ]);

        Task::create([
            'description' => $request->description,
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|max:255',
        ]);

        $task = Task::find($id);
        $task->description = $request->description;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function complete(Request $request, $id)
    {
        $data = $request->has('completed') ? 1 : 0;
        $task = Task::find($id);
        $task->is_completed = $data;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function clearCompleted()
    {
        Task::where('is_completed', 1)->delete();
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
