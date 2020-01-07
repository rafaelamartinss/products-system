<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\User;
use App\Notifications\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function sendNotification() {
        $user = User::first();

        Mail::to("rafaelalealmartinss@gmail.com")->send(new WelcomeMail());

        dd('done');
    }
}
