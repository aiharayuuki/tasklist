<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 最新の自分のタスクを取得
        $tasks = Auth::user()->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);

        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = auth()->id();
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);

        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}