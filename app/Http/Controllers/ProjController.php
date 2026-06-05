<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjController extends Controller
{
    function projecttable(){
        $projects = Projects::where('user_id', session('user')->id)
        ->orderByRaw("
            CASE status
                WHEN 'Pending' THEN 1
                WHEN 'Ongoing' THEN 2
                WHEN 'Completed' THEN 3
                ELSE 4
            END
        ")->get();

        // Get statistics
        $totalProjects = $projects->count();
        $pendingProjects = $projects->where('status', 'Pending')->count();
        $ongoingProjects = $projects->where('status', 'Ongoing')->count();
        $completedProjects = $projects->where('status', 'Completed')->count();

        return view('home', compact('projects', 'totalProjects', 'pendingProjects', 'ongoingProjects', 'completedProjects'));
    }

    function addproj(Request $request){
        Projects::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => 'Pending',
            'user_id' => session('user')->id
        ]);

        return back()->with('success', 'Project list updated.');
    }

    function editproj(Request $request, $id){
        $proj = Projects::where('id', $id)->where('user_id', session('user')->id)->first();

        if (!$proj){
            return back()->with('error', "Task doesn't exist!");
        }

        $proj->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->input('status')
        ]);

        return back()->with('success', 'Project successfully edited!');
    }

    function deleteproj($id){
        $proj = Projects::where('id', $id)->where('user_id', session('user')->id)->first();

        if(!$proj){
            return back()->with('sucess', 'Unable to delete project.');
        }

        $proj->delete();

        return back()->with('success', 'Project deleted successfully!');
    }
}
