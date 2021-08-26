<?php

namespace App\Http\Controllers;

use App\Type;
use App\Client;
use App\Appointment;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\FacebookDriver;

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
        $clients=Client::all();
        $appointments=Appointment::all();
        $types=Type::all();
        return view('home')->with('clients',$clients)->with('appointments',$appointments)->with('types',$types);
    }
}
