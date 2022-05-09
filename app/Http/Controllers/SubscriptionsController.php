<?php

namespace App\Http\Controllers;
use App\Models\Universidades;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {

        $subscription = new Subscription();
        $subscription->user_id = auth()->user()->id;
        //$subscription->universidade_id = request('subscribe');
        $subscription->universidade_name = request('subscribe');
        //dd($subscription->universidade_name);


        //botar todos
        $subscription->save();

        return redirect()->back();
    }


    public function remove($id){

        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->back();
    }
}
