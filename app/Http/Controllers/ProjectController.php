<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Project;
use App\Category;
use App\Photo;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function show($id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        return view('projects.show', ['project' => $project]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('projects.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'description'   => 'required|string',
            'difficulty'    => 'required|numeric',
        ]);

        // If the input is wrong then return false and an object with the errors
        if ($validator->fails()) 
            return ['error' => true, 'errors' => $validator->errors()->all()];

        // Store the data in the DB
        $current_user = Auth::user();
        $project = Project::create([
            'name'          => $request['name'],
            'owner'         => $current_user->id,
            'description'   => $request['description'],
            'difficulty'    => $request['difficulty'],
            'document'      => NULL
        ]);

        $request->categories = explode(",", $request->categories);
        if (count($request->categories) > 1)
        {
                $project->categories()->attach($request->categories);
        }

        if ($request->hasFile('photos'))
        {
            $files = $request->file('photos');
            foreach ($files as $file)
            {
                $path = $file->store('public/images');
                Photo::create([
                    'path'          => $path,
                    'project_id'    => $project->id
                ]);
            }
        }

        if ($request->hasFile('document'))
        {
            $path = $request->document->store('public/documents');
            $project->document = $path;
            $project->save();
        }

        return ['success' => true];
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        $project->delete();
        return ['success' => true];
    }
}
