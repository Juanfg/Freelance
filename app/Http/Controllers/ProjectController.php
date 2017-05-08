<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Project;
use App\Category;
use App\Photo;
use App\User;

class ProjectController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();
        $projects = Project::where('owner', $current_user->id)->get();
        return view('projects.index', ['projects' => $projects]);
    }

    public function show($id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        $current_user = Auth::user();
        $project_collaborators = Project::find($id)->collaborators()->get();
        $status=0;
        if($project->owner == $current_user->id && $project->active)
            $status=1; //Finish Project
        else if ($project->owner != $current_user->id && $project->active)
        {
            $status=2; //Join Project
            foreach($project_collaborators as $collaborator)
            {
                if($current_user->id == $collaborator->id)
                {
                    $status=3; //Leave Project
                    break;
                }
            }           
        }
        else if(!$project->active)
            $status=4; //Project is already finished
    

        return view('projects.show', ['project' => $project, 'status' => $status]);
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
        $current_user = Auth::user();
        $project = Project::find($id);
        $categories_user = $project->categories()->pluck('categories.id');
        $categories = Category::whereNotIn('id', $categories_user)->get();
        return view('projects.update', ['project' => $project, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'description'   => 'required|string',
            'difficulty'    => 'required|numeric',
        ]);

        $current_photos = explode(",", $request->current_photos);
        $photos_to_delete = Project::find($id)->photos()->whereNotIn('id', $current_photos)->select('id')->get();
        $photos_to_delete = $photos_to_delete->toArray();

        $categories_request = explode(",", $request->categories);
        $model_categories_to_delete = Project::find($id)->categories()->whereNotIn('categories.id', $categories_request)->select('categories.id')->get();
        $model_categories_to_delete = $model_categories_to_delete->toArray();
        $categories_to_delete = array();
        for ($i = 0; $i < count($model_categories_to_delete); $i++)
            array_push($categories_to_delete, $model_categories_to_delete[$i]['id']);

        $current_categories = Project::find($id)->categories()->get();

        $categories_to_add = array();
        for ($i = 0; $i < count($categories_request); $i++)
        {
            $isInCollection = false;
            foreach ($current_categories as $category)
            {
                if ($category->id == $categories_request[$i])
                {
                    $isInCollection = true;
                    break;
                }
            }
            if (!$isInCollection)
                array_push($categories_to_add, $categories_request[$i]);
        }

        $project = Project::find($id);

        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->difficulty = $request['difficulty'];


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

        $doc = $request['document'];
        $photos = $request['photos'];
        if ($request->hasFile('document'))
        {
            //TODO: Delete current file if has one
            $path = $request->document->store('public/documents');
            $project->document = $path;
        }

        Photo::destroy($photos_to_delete);

        if (count($categories_to_delete) > 0)
        {
            $project->categories()->detach($categories_to_delete);
        }

        if (count($categories_to_add) > 0)
        {
            $project->categories()->attach($categories_to_add);
        }

        $project->save();

        return ['success' => true];
    }

    public function destroy($id)
    {
        $project = Project::where('id', $id)->firstOrFail();
        $project->delete();
        return ['success' => true];
    }

    public function downloadDocument($id)
    {
        $project = Project::where('id', $id)->first();
        $file = str_replace("public", "storage", $project->document);
        return Response::download($file);
    }

    public function collaborating()
    {
        $current_user = Auth::user();
        $projects_collaborating = User::find($current_user)->projectsCollaborating()->where('projects.active', true)->wherePivot('active', true)->get();
        return view('projects.collaborating', ['projects' => $projects_collaborating]);
    }

    public function join($id)
    {
        $current_user = Auth::user();
        $project = Project::find($id);
        $project->collaborators()->attach([$current_user->id]);
        return ['success' => true];
    }

    public function leave($id)
    {
        $current_user = Auth::user();
        $project = Project::find($id);
        $project->collaborators()->detach([$current_user->id]);
        return ['success' => true];
    }

    public function finish($id)
    {
        $current_user = Auth::user();
        $project = Project::find($id);
        $project->active = false;
        $project->save();
        return ['success' => true];
    }
}
