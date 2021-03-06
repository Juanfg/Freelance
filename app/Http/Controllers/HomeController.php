<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Project;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $projects_user = User::find($current_user->id)->projects()->pluck('projects.id');
        $projects_collaborating = User::find($current_user->id)->projectsCollaborating()->pluck('projects.id');
        $projects = Project::whereNotIn('id', $projects_collaborating)->whereNotIn('id', $projects_user)->where('active', true)->get();
        return view('home', ['projects' => $projects]);
    }
}
