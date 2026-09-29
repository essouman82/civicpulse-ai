<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboardController;
use App\Http\Controllers\Admin\StatisticsController;

use App\Http\Controllers\IncidentController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| PAGE D'ACCUEIL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ROUTE DE TEST
|--------------------------------------------------------------------------
| À supprimer plus tard lorsque tout fonctionne.
*/

Route::get('/test-users', function () {
    return 'La route fonctionne';
})->name('users.test');


/*
|--------------------------------------------------------------------------
| ROUTES DES UTILISATEURS CONNECTÉS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | REDIRECTION DU DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'administrateur') {

            return redirect()->route('admin.dashboard');

        }

        if (auth()->user()->role === 'agent') {

            return redirect()->route('agent.dashboard');

        }

        return redirect()->route('citizen.dashboard');

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMINISTRATEUR
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:administrateur')->group(function () {

        // Dashboard administrateur
        Route::get(
            '/admin/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('admin.dashboard');
Route::get('/admin/statistiques', [StatisticsController::class, 'index'])
    ->name('admin.statistics'); 

        // Gestion des utilisateurs
        Route::get(
            '/users',
            [UserController::class, 'index']
        )->name('users.index');

        Route::get(
            '/users/create',
            [UserController::class, 'create']
        )->name('users.create');

        Route::post(
            '/users',
            [UserController::class, 'store']
        )->name('users.store');

        Route::get(
            '/users/{user}/edit',
            [UserController::class, 'edit']
        )->name('users.edit');

        Route::put(
            '/users/{user}',
            [UserController::class, 'update']
        )->name('users.update');

        Route::delete(
            '/users/{user}',
            [UserController::class, 'destroy']
        )->name('users.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | AGENT
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:agent')->group(function () {

        Route::get(
            '/agent/dashboard',
            [AgentDashboardController::class, 'index']
        )->name('agent.dashboard');

    });

/*
|--------------------------------------------------------------------------
| CITOYEN
|--------------------------------------------------------------------------
*/

Route::middleware('role:citoyen')->group(function () {

    Route::get(
        '/citizen/dashboard',
        [CitizenDashboardController::class, 'index']
    )->name('citizen.dashboard');

});
   /*
|--------------------------------------------------------------------------
| INCIDENTS
|--------------------------------------------------------------------------
| Administrateur + Agent + Citoyen
|--------------------------------------------------------------------------
*/

Route::middleware('role:administrateur,agent,citoyen')->group(function () {

    Route::resource(
        'incidents',
        IncidentController::class
    );

});


/*
|--------------------------------------------------------------------------
| INTERVENTIONS
|--------------------------------------------------------------------------
| Administrateur + Agent
|--------------------------------------------------------------------------
*/

Route::middleware('role:administrateur,agent')->group(function () {

    Route::resource(
        'interventions',
        InterventionController::class
    );

});


    /*
    |--------------------------------------------------------------------------
    | CARTE DES INCIDENTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/incidents-map',
        [IncidentController::class, 'map']
    )->name('incidents.map');


    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';