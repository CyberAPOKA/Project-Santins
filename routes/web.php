<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversidadesController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});

Route::get('/',[HomeController::class, 'index'])->name('home.index');

Route::get('/home',[HomeController::class, 'role'])->name('home.role');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/universidades', [UniversidadesController::class, 'index'])->name('universidades.index');

    Route::any('/universidades/search', [UniversidadesController::class, 'search'])->name('universidades.search');

    Route::post('/subscription', [SubscriptionsController::class, 'store'])->name('subscription.store');

    Route::get('/universidades/create', [UniversidadesController::class, 'create'])->name('universidades.create');

    //Route::get('/universidades/create', [UniversidadesController::class, 'create'])->name('universidades.create');

    Route::post('/universidades/store', [UniversidadesController::class, 'store'])->name('universidades.store');

    Route::get('/universidades/subscribe', [UniversidadesController::class, 'subscribe'])->name('universidades.subscribe');

    Route::delete('/subscription/remove/{id}', [SubscriptionsController::class, 'remove'])->name('subscription.remove');

    Route::post('/universidades/status/{id}', [UniversidadesController::class, 'status'])->name('universidades.status');

    Route::delete('/universidades/delete/{id}', [UniversidadesController::class, 'delete'])->name('universidades.delete');

   // Route::get('/admin', [HomeController::class, 'admin'])->name('admin.admin');
});
