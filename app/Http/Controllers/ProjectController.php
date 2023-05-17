<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            Project::create([
                "name" => $request->name,
            ]);
            return redirect()->back()->with('success', 'Project created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, there was an error');
        }


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            Project::whereId($id)->update([
                "name" => $request->name
            ]);
            return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, there was an error');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Project::whereId($id)->delete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, there was an error');
        }

    }
}
