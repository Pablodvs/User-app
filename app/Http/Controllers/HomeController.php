<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){ // Check if the user is authenticated
            return view('layouts.users.index'); // If authenticated, show the user's index page
        }else{
            return view('home'); // If not authenticated, show the home page
        }
    }
}
