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

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $finished_projects = $user->projectsCollaborating()->where('projects.active',false)->wherePivot('active', true)->get();
        $projects_requests = User::find($id)->projects()->where('active', true)->get();
        foreach ($projects_requests as $project)
        {
            $not_collaborating = $project->collaborators()->wherePivot('active', false)->get();
            if ($not_collaborating)
                $project->not_accepted_collaborators = $not_collaborating;
        }
        return view('users.show', ['user' => $user, 'finished_projects' => $finished_projects, 'projects_requests' => $projects_requests]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('users.update',['user' => $user]);  
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string',
            'subtitle'   => 'required|string',
            'bio'    => 'required|string',
            'password'    => 'required|string|min:6|confirmed',
        ]);

        $user = User::find($id);

        $user->name = $request['name'];
        $user->subtitle = $request['subtitle'];
        $user->bio = $request['bio'];
        

        if($request->password)
        {
            $user->password = bcrypt($request['password']);
            $user->token_password = sha1($user->password);
        }

        if ($request->hasFile('profile'))
        {
            $file = $request->file('profile');

            $path = $file->store('public/images');

            $user->profile_picture = $path;
        }

        if ($request->hasFile('resume'))
        {
            $file = $request->file('resume');

            $path = $file->store('public/documents');

            $user->resume = $path;
        }

        $user->save();

        return redirect()->route('users.show', $id);

    }

    public function destroy($id)
    {
        
    }

    public function downloadDocument($id)
    {
        $user = User::where('id', $id)->first();
        $file = str_replace("public", "storage", $user->resume);
        return Response::download($file);
    }

    public function getAllUsers()
    {
        $users = User::all();
        return view('admin.manage_users',['users' => $users]);
    }

    public function activateUser($id)
    {
        $users = User::all();
        $user = User::find($id);
        $user->active = true;
        $user->save();
        return redirect()->route('manage_users', ['users' => $users]);
    }

    public function deactivateUser($id)
    {
        $users = User::all();
        $user = User::find($id);
        $user->active = false;
        $user->save();
        return redirect()->route('manage_users', ['users' => $users]);
    }
}
