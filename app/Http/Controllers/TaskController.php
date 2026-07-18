<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function add(){

    $tasks = Task::all();
    return view('add', compact('tasks'));
    }

    // Store Tasks
    function store(Request $request){

    // dd($request->all());

         $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'status' => 'required|in:Pending,Completed',
    ]);

        $task = new Task();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->status = $validated['status'];
        $task->save();

        return redirect()->route('dashboard')->with('add-success','Task added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = base64_decode($id);

        $Data = Task::findOrFail($id);

        return view('edit', compact('Data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'status' => 'required|in:Pending,Completed',
    ]);

        $Data = Task::findOrFail(base64_decode($id));
        $Data->title = $validated['title'];
        $Data->description = $validated['description'];
        $Data->status = $validated['status'];
        $Data->save();

        return redirect()->route('dashboard')->with('edit-success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //  Task::where('id', base64_decode($id))->delete();

        $id = base64_decode($id);

        Task::findOrFail($id)->delete();

         return redirect()->route('dashboard')->with('delete-success','Task deleted successfully');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Pending,Completed',
    ]);

    $id = base64_decode($id);

    $task = Task::findOrFail($id);

    $task->status = $request->status;

    $task->save();

    return redirect()->route('dashboard')
                     ->with('edit-success', 'Task status updated successfully.');
}
}