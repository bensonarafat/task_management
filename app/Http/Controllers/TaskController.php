<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectId = $request->input('project_id');
        $tasks = Task::when($projectId, function ($query, $projectId) {
            $query->where('project_id', $projectId);
        })->with("project")->orderBy('priority')->get();

        $projects = Project::all();

        return view('index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required',
            'name' => 'required',
            'priority' => 'required|integer',
        ]);

        try{
            Task::create($data);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Oops, there was an error');
        }



        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::all();
        $task = Task::find($id);
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'project_id' => 'required',
            'name' => 'required',
            'priority' => 'required|integer',
        ]);

        try{
            Task::whereId($id)->update([
                "project_id" => $request->project_id,
                "name" => $request->name,
                "priority" => $request->priority,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Oops, there was an error');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            Task::whereId($id)->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, there was an error');
        }

    }


    /**
     * Update task priority order
     */
    public function updateOrder(Request $request){
        $order = $request->input('task');
        foreach ($order as $index => $taskId) {
            $task = Task::findOrFail($taskId);
            $task->priority = $index + 1;
            $task->save();
        }
        return response()->json(['order' => true], 200);
    }
}
