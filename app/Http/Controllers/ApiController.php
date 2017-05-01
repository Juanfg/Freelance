<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\User;

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
     *       The function will return a JSON with state=401, status_msg=WRONG PASSWORD and an empty array if password doesn't correspond to the user 
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
            $project->owner = $project->owner()->select('name')->get();
            $project->collaborators = $project->collaborators()->select('name')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects
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
            $project->collaborators = $project->collaborators()->select('name')->get();
        }
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $projects
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
        $project->owner = $project->owner()->select('name')->get();
        $project->collaborators = $project->collaborators()->select('name')->get();
        return json_encode(
            array(
                'state' => 200,
                'status_msg' => 'OK',
                'data' => $project
            )
        );
    }
}
