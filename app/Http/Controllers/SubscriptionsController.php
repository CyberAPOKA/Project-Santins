<?php

namespace App\Http\Controllers;

use App\Models\Universidades;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {
        $subscription = new Subscription();

        $subscription->user_id = auth()->user()->id;
        $subscription->user_name = auth()->user()->name;
        $subscription->universidade_id = $request->input('subscribe');
        $subscription->universidade_name = $request->input('subscribe2');

        // Limita 1 inscrição por usuário

        $limit = Subscription::where('user_id', $subscription->user_id)
            ->where('universidade_name', $subscription->universidade_name)->exists();
        if ($limit) {
            return redirect()->back()->with('subscriptionExist', 'dale');
        } else {
            $subscription->save();
            return redirect()->back()->with('subscription', 'dale');
        }
    }


    public function remove($id)
    {

        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->back()->with('subscriptionDelete', 'dale');
    }
}
