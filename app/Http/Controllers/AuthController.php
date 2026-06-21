<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'Veuillez entrer une adresse email valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'      => 'Le mot de passe doit contenir au moins 6 caractères.',
        ]);

        $remember = $request->has('rememberMe');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->with('success', 'Connexion réussie. Bienvenue !');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent à aucun compte.',
        ])->onlyInput('email');
    }

    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription
     */
    public function register(Request $request)
    {
        $validform = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'nullable|in:admin,gestionnaire',
        ], [
            'name.required'      => 'Le nom complet est obligatoire.',
            'email.required'     => 'L\'adresse email est obligatoire.',
            'email.email'        => 'Veuillez entrer une adresse email valide.',
            'email.unique'       => 'Cette adresse email est déjà utilisée.',
            'password.required'  => 'Le mot de passe est obligatoire.',
            'password.min'       => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $validform['password'] = Hash::make($validform['password']);
        $validform['role'] = $validform['role'] ?? 'gestionnaire';

        $user = User::create($validform);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Compte créé avec succès. Bienvenue !');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
