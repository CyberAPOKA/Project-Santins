<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universidades;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UniversidadeRequest;
use Illuminate\Support\Facades\DB;

class UniversidadesController extends Controller
{
    public function json(Request $request)
    {

        $limit = 0;

        if ($request->isMethod('post')) {

            $userData = $request->input();
            foreach ($userData['universidades'] as $key => $value) {
                if (++$limit > 100) break;
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

    public function index(Request $request)
    {

        $user = Auth::user();
        $role = Auth::user()->role;
        $universidades = Universidades::latest()->orderBy('id', 'desc')->paginate(10);
        $subscriptions = Auth::user()->subscription()->pluck('universidade_id');

        return view('universidades', compact('universidades', 'user', 'role', 'subscriptions'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $role = Auth::user()->role;
        $filters = $request->all();
        $subscriptions = Auth::user()->subscription()->pluck('universidade_id');
        $universidades = Universidades::where('alpha_two_code', 'LIKE', "%{$request->search}%")
            ->orWhere('country', 'LIKE', "%{$request->search}%")
            ->orWhere('domains', 'LIKE', "%{$request->search}%")
            ->orWhere('name', 'LIKE', "%{$request->search}%")
            ->orWhere('state_province', 'LIKE', "%{$request->search}%")
            ->orWhere('web_pages', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('universidades', compact('universidades', 'filters', 'user', 'role', 'subscriptions'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        return view('universidades_create', compact('user'));
    }

    public function store(UniversidadeRequest $request)
    {

        $user = Auth::user();
        $universidades = new Universidades();

        $universidades->alpha_two_code = $request->input('alpha_two_code');
        $universidades->country = $request->input('country');
        $universidades->domains = $request->input('domains');
        $universidades->name = $request->input('name');
        $universidades->web_pages = $request->input('web_pages');
        if ($user->role == 0) {
            $universidades->status = 1;
        } else {
            $universidades->status = 0;
        }
        $universidades->save();
        return redirect()->route('home.index')->with('success', 'zzz');
    }

    public function subscribe(Request $request)
    {

        $user = Auth::user();
        $subscribe = $user->subscription;



        return view('universidades_subscribe', compact('user', 'subscribe'));
    }

    public function status(Request $request, $id)
    {

        $universidades = Universidades::find($id);
        Universidades::find($id)->update([
            'status' => $request->input('status'),
        ]);


        return redirect()->back()->with('universidadeStatus', 'x');
    }


    public function delete($id)
    {

        $universidades = Universidades::findOrFail($id);
        $universidades->delete();

        return redirect()->back()->with('deleteUniversidades', 'x');
    }

    public function subscriptions()
    {
        $user = Auth::user();
        $role = Auth::user()->role;
        $subscriptions = Subscription::latest()->orderBy('id', 'desc')->paginate(10);

        return view('subscriptions', compact('user', 'role', 'subscriptions'));
    }

    public function remove($id)
    {

        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->back()->with('subscriptionDelete', 'dale');
    }

    public function searchEnrollments(Request $request)
    {
        $user = Auth::user();
        $role = Auth::user()->role;
        $filters = $request->all();
        $enrollments = Auth::user()->subscription()->pluck('universidade_id');
        $subscriptions = Subscription::where('user_id', 'LIKE', "%{$request->search}%")
            ->orWhere('user_name', 'LIKE', "%{$request->search}%")
            ->orWhere('universidade_id', 'LIKE', "%{$request->search}%")
            ->orWhere('universidade_name', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('subscriptions', compact('enrollments', 'filters', 'user', 'role', 'subscriptions'));
    }

    public function searchAdmin(Request $request)
    {
        $user = Auth::user();
        $role = Auth::user()->role;
        $filters = $request->all();
        $subscriptions = Auth::user()->subscription()->pluck('universidade_id');
        $universidades = Universidades::where('alpha_two_code', 'LIKE', "%{$request->search}%")
            ->orWhere('country', 'LIKE', "%{$request->search}%")
            ->orWhere('domains', 'LIKE', "%{$request->search}%")
            ->orWhere('name', 'LIKE', "%{$request->search}%")
            ->orWhere('state_province', 'LIKE', "%{$request->search}%")
            ->orWhere('web_pages', 'LIKE', "%{$request->search}%")
            ->orWhere('status', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin', compact('universidades', 'filters', 'user', 'role', 'subscriptions'));
    }
}
