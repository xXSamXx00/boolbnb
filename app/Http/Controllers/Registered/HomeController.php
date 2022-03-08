<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $apartments_online = Auth::user()->apartments()->orderByDesc('id')->where('visibility', true)->get();
        $apartments_offline = Auth::user()->apartments()->orderByDesc('id')->where('visibility', false)->get();

        return view('registered.home', compact('apartments_online', 'apartments_offline'));
    }
}