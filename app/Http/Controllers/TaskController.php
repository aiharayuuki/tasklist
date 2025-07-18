<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ログインユーザーのタスクのみ取得
        $tasks = Task::where('user_id', auth()->id())->get();

        // 一覧表示ビューへ渡す
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'status' => 'required|max:10',
        ]);

        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = auth()->id(); // ログインユーザーのIDを保存
        $task->save();

        return redirect()->route('tasks.index'); // 👈 ここ変更
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
    return redirect()->route('tasks.index');
        }

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
    return redirect()->route('tasks.index');
        }

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
    return redirect()->route('tasks.index');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
    return redirect()->route('tasks.index');
        }

        $task->delete();

    return redirect()->route('tasks.index');
    }
}