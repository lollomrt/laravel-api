<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProjectController as ProjectController;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('category', 'technologies')->paginate(4);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug){
        $project = Project::with('category', 'technologies')->where('slug', $slug)->first();
        if($project){
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'Nessun progetto trovato'
            ]);
        }
    }
}
