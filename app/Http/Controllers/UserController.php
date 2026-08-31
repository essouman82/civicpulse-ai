<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $users = \App\Models\User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('users.index', compact('users', 'search'));
}

    public function create()
    {
        return view('users.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
        'role' => 'required|in:administrateur,agent,citoyen',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur créé avec succès.');
}

    public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:administrateur,agent,citoyen',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'confirmed|min:8',
        ]);

        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur modifié avec succès.');
}

    public function destroy(User $user)
{
    // Empêcher la suppression de son propre compte
    if (auth()->id() === $user->id) {
        return redirect()
            ->route('users.index')
            ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
    }

    // Empêcher la suppression du dernier administrateur
    if ($user->role === 'administrateur') {

        $nombreAdministrateurs = User::where('role', 'administrateur')->count();

        if ($nombreAdministrateurs <= 1) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Impossible de supprimer le dernier administrateur.');
        }
    }

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur supprimé avec succès.');
}
}