<?php

namespace App\Http\Controllers;

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
     * Redirect the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @var role : 1 => UserNormal, 2 => Kader, 3 => KaDes, 4 => Admin
     */
    public function redirect()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case "1":
                return redirect()->route('user.dashboard');
                break;
            case "2":
                return redirect()->route('kader.dashboard');
                break;
            case "3":
                echo "kades";
                return redirect()->route('kades.dashboard');
                break;
            case "4":
                return redirect()->route('admin.dashboard');
                break;
            default:
                abort(403);
        }
    }

    public function test() {
        return view('home');
    }
}
