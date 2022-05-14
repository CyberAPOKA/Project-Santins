<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Universidades;

class HomeController extends Controller
{

    public function index(){

        $user = Auth::user();

        $universidades = Universidades::latest()->orderBy('id', 'desc')->paginate(10);

        return view('welcome', compact('universidades', 'user'));
    }

    public function role(){

        $universidades = Universidades::latest()->orderBy('id', 'desc')->paginate(10);
        $user = Auth::user();

        $role = Auth::user()->role ?? 0;
        if($role=='1'){
            return view('admin', compact('universidades', 'role', 'user'));
        }else{
            return view('universidades', compact('universidades', 'role', 'user'));
            }

    }
}
