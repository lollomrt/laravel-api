<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Mail\NewContact;
use App\Models\Lead;
// use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;



use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $form_data['slug'] = $slug;
        $newProject = new Project();

        if($request->has('cover_image')){
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $newProject->fill($form_data);
        
        $newProject -> save();
        
        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }

        $newLead = new Lead();
        $newLead->title = $form_data['title'];
        $newLead->content = $form_data['content'];
        $newLead->slug = $form_data['slug'];

        $newLead->save();

        Mail::to('info@portfolio.com')->send(new NewContact($newLead));

        return redirect()->route('admin.projects.index')->with('message', 'Il progetto è stato creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.show', compact('project', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $form_data['slug'] = $slug;
        if($request->has('cover_image')){
            if($project->cover_image){
                Storage::delete($project->cover_image);
            }
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        $project->update($form_data);

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }


        return redirect()->route('admin.projects.index')->with('message', $project->title.' è stato modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Progetto eliminato con successo');
    }

    // private function validation($data){
    //     $validator = Validator::make($data, [
    //         'title' => 'required|max:150',
    //         'content' => 'nullable'
    //     ],
    //     [
    //         'title.required' => 'Il titolo è obbligatorio',
    //         'title.max' => 'Il titolo non piò superare :max parole',

    //     ])->validate();

    //     return $validator;
    // }
}
