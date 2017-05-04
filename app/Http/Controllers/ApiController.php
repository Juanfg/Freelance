<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;
use App\Category;
use App\Photo;

class ApiController extends Controller
{
    /**
     * Name: register
     * Parameters: name, email, password
     * Success: The function will return a JSON with state=200, status_msg=OK and an array with the data of the user. Also the user will be register in the DB.
     * Fail: The function will return a JSON with state=409, status_msg=USER ALREADY EXIST and an empty array
     * How to call: http://<ip>:<port(defaul=8000)>/api/register?name=<name>&email=<email>&password=<password>
    */
    public function register(Request $request)
    {
        $userAlreadyExists = User::where('email', $request->email)->count();
        if ($userAlreadyExists > 0)
            return json_encode(
                array(
                    'state'         => 409,
                    'status_msg'    => 'USER ALREADY EXIST',
                    'data'          => array()
                )
            );
        
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'token_password'    => sha1($request->password)
        ]);
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data'  => array(
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email
                )
            )
        );
    }

    /**
     * Name: login
     * Parameters: email, password
     * Success: The function will return a JSON with state=200, status_msg=OK and an array with the data of the user.
     * Fail: The function will return a JSON with state=404, status_msg=USER NOT FOUND and an empty array if the user is not found in the DB,
     * The function will return a JSON with state=401, status_msg=WRONG PASSWORD and an empty array if password doesn't correspond to the user 
     * How to call: http://<ip>:<port(defaul=8000)>/api/login?email=<email>&password=<password>
    */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'USER NOT FOUND',
                    'data' => array()
                )
            );


        $password = sha1($request->password);
        if ($user->token_password === $password)
            return json_encode(
                array(
                    'state' => 200,
                    'status_msg' => 'OK',
                    'data'  => array(
                        'user_id'   => $user->id,
                        'name'      => $user->name,
                        'email'     => $user->email
                    )
                )
            );
        else
            return json_encode(
                array(
                    'state'         => 401,
                    'status_msg'    => 'WRONG PASSWORD',
                    'data'          => array()
                )
            );
    }

    /**
     * Name: getAllProjects
     * Parameters:
     * Success: The function will return a JSON with state=200, status_msg=OK and an array with the data of all the projects.
     * Fail: The function will return a JSON with state=404, status_msg=NO PROJECTS and an empty array
     * How to call: http://<ip>:<port(defaul=8000)>/api/getAllProjects
    */
    public function getAllProjects()
    {
        $projects = Project::all();
        if ($projects->count() <= 0)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'NO PROJECTS',
                    'data' => array()
                )
            );

        foreach ($projects as $project)
        {
            $project->categories = $project->categories()->select('name')->get();
            $photos = $project->photos()->select('path')->get();
            foreach ($photos as $photo)
                $photo->path = str_replace("public", "storage", $photo->path);
            $project->photos = $photos;
            $project->document = str_replace("public", "storage", $project->document);
            $project->owner = $project->owner()->select('name', 'email')->first();
            $project->collaborators = $project->collaborators()->select('name', 'email')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects
            )
        );
    }

    public function getJoinedProjects(Request $request)
    {
        $projects = User::find($request->user_id)->projectsCollaborating()->get();
        $user = User::find($request->user_id);
        if ($projects->count() <= 0)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'NO PROJECTS',
                    'data' => array()
                )
            );
        
        foreach ($projects as $project)
        {
            $project->categories = $project->categories()->select('name')->get();
            $photos = $project->photos()->select('path')->get();
            foreach ($photos as $photo)
                $photo->path = str_replace("public", "storage", $photo->path);
            $project->photos = $photos;
            $project->document = str_replace("public", "storage", $project->document);
            $project->owner = $project->owner()->select('name', 'email')->first();
            $project->collaborators = $project->collaborators()->select('name', 'email')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects,
                'user_name' => $user->name
            )
        );
    }

    public function getNotJoinedProjects(Request $request)
    {
        $projects_collaborating = User::find($request->user_id)->projectsCollaborating()->pluck('projects.id');
        $projects = Project::whereNotIn('id', $projects_collaborating)->whereNotIn('owner', [$request->user_id])->get();
        $user = User::find($request->user_id);
        if ($projects->count() <= 0)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'NO PROJECTS',
                    'data' => array()
                )
            );

        foreach ($projects as $project)
        {
            $project->categories = $project->categories()->select('name')->get();
            $photos = $project->photos()->select('path')->get();
            foreach ($photos as $photo)
                $photo->path = str_replace("public", "storage", $photo->path);
            $project->photos = $photos;
            $project->document = str_replace("public", "storage", $project->document);
            $project->owner = $project->owner()->select('name', 'email')->first();
            $project->collaborators = $project->collaborators()->select('name')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects,
                'user_name' => $user->name
            )
        );
    }

    /**
     * Name: getMyProjects
     * Parameters: user_id
     * Success: The function will return a JSON with state=200, status_msg=OK and an array with the data of the projects of the user.
     * Fail: The function will return a JSON with state=404, status_msg=NO PROJECTS and an empty array
     * How to call: http://<ip>:<port(defaul=8000)>/api/getMyProjects?user_id=<user_id>
    */
    public function getMyProjects(Request $request)
    {
        $user = User::find($request->user_id);
        $projects = $user->projects()->get();
        if ($projects->count() <= 0)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'NO PROJECTS',
                    'data' => array()
                )
            );

        foreach ($projects as $project)
        {
            $project->categories = $project->categories()->select('name')->get();
            $photos = $project->photos()->select('path')->get();
            foreach ($photos as $photo)
                $photo->path = str_replace("public", "storage", $photo->path);
            $project->photos = $photos;
            $project->document = str_replace("public", "storage", $project->document);
            $project->owner = $user->name;
            $project->owner_email = $user->email;            
            $project->collaborators = $project->collaborators()->select('name', 'email')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects,
                'user_name' => $user->name
            )
        );
    }

    /**
     * Name: getProject
     * Parameters: project_id
     * Success: The function will return a JSON with state=200, status_msg=OK and an array with the data of the project.
     * Fail: The function will return a JSON with state=404, status_msg=PROJECT NOT FOUND and an empty array
     * How to call: http://<ip>:<port(defaul=8000)>/api/getProject?project_id=<project_id>
    */
    public function getProject(Request $request)
    {
        $project = Project::find($request->project_id);
        if (!$project)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'PROJECT NOT FOUND',
                    'data' => array()
                )
            );

        $project->categories = $project->categories()->select('name')->get();
        $photos = $project->photos()->select('path')->get();
        foreach ($photos as $photo)
            $photo->path = str_replace("public", "storage", $photo->path);
        $project->photos = $photos;
        $project->document = str_replace("public", "storage", $project->document);
        $project->owner = $project->owner()->select('name', 'email')->first();
        $project->collaborators = $project->collaborators()->select('name', 'email')->get();
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $project
            )
        );
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        if ($categories->count() <= 0)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'CATEGORIES NOT FOUND',
                    'data' => array()
                )
            );

        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK', 
                'data' => $categories
            )
        );
    }

    public function createProject(Request $request)
    {
        $project = Project::create([
            'name'          => $request->name,
            'owner'         => $request->user_id,
            'description'   => $request->description,
            'difficulty'    => $request->difficulty,
            'document'      => NULL
        ]);

        $category = Category::where('name', $request->category)->first();
        $project->categories()->attach($category->id);

         Photo::create([
                'path' => 'public/images/img_not_available.png',
                'project_id' => $project->id,
        ]);

        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $project
            )
        );
    }

    public function updateProject(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        if (!$project)
            return json_encode(
              array(
                    'state' => 404,
                    'status_msg' => 'PROJECT NOT FOUND',
                    'data' => array()
                )
            );


        $project->name = $request->name;
        $project->description = $request->description;
        $project->difficulty = $request->difficulty;
        $project->save();

        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $project
            )
        );
    }

    public function getUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if (!$user)
            return json_encode(
                array(
                    'state' => 404, 
                    'status_msg' => 'USER NOT FOUND',
                    'data' => array()
                )
            );

        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $user
            )
        );
    }

    public function updateUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if (!$user)
            return json_encode(
                array(
                    'state' => 404, 
                    'status_msg' => 'USER NOT FOUND',
                    'data' => array()
                )
            );
        
        $user->name = $request->name;   
        $user->password = bcrypt($request->password);
        $user->token_password = sha1($request->password);
        $user->save();

        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => array(
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email
                )
            )
        ); 
    }

    public function joinProject(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        
        if (!$project)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'PROJECT NOT FOUND',
                    'data' => array()
                )
            );
        
        $project->collaborators()->attach($request->user_id);
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                array()
            )
        );
    }

    public function deleteProject(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        if (!$project)
            return json_encode(
                array(
                    'state' => 404,
                    'status_msg' => 'PROJECT NOT FOUND',
                    'data' => array()
                )
            );
        
        $project->delete();
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                array()
            )
        );
    }
}
