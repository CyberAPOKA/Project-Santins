<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universidades;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class UniversidadesController extends Controller
{
    public function json(Request $request){

        $limit = 0;

        if($request->isMethod('post')){

            $userData = $request->input();
            foreach($userData['universidades'] as $key => $value){
                if(++$limit > 100) break;
        $universidades = new Universidades();
        $universidades->alpha_two_code = $value['alpha_two_code'];
        $universidades->country = $value['country'];
        $universidades->domains = $value['domains'];
        $universidades->name = $value['name'];
        $universidades->state_province = $value['state_province'];
        $universidades->web_pages = $value['web_pages'];

        $universidades->save();

    }
        return response()->json($universidades);
        }
    }

    public function index(){

        $universidades = Universidades::latest()->orderBy('id', 'desc')->paginate(10);

        return view('universidades', compact('universidades'));
    }

    public function search(Request $request){

        //dd("teste {$request->search}");
        $filters = $request->all();

        $universidades = Universidades::where('alpha_two_code', 'LIKE', "%{$request->search}%")
        ->orWhere('country', 'LIKE', "%{$request->search}%")
        ->orWhere('domains', 'LIKE', "%{$request->search}%")
        ->orWhere('name', 'LIKE', "%{$request->search}%")
        ->orWhere('state_province', 'LIKE', "%{$request->search}%")
        ->orWhere('web_pages', 'LIKE', "%{$request->search}%")
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('universidades', compact('universidades','filters'));

    }

    public function create(Request $request){


        return view('universidades_create');

    }

    public function store(Request $request){

        $universidades = new Universidades();

        $universidades->alpha_two_code = $request->input('alpha_two_code');
        $universidades->country = $request->input('country');
        $universidades->domains = $request->input('domains');
        $universidades->name = $request->input('name');
        $universidades->web_pages = $request->input('web_pages');
        $universidades->status = 1;
        $universidades->save();

        return redirect()->back()->with('success', 'zzz');
    }

    public function subscribe(Request $request){

        $user = Auth::user();
        $subscribe = $user->subscription;


        return view('universidades_subscribe', compact('user','subscribe'));
    }

}
