<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        
        return view('login.forms.neon-cyber.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

            if (! Auth::attempt($credenciais, $request->boolean('remember'))) {
            return back()->withErrors([ 
                'email' => 'Credenciais inválidas.',
                ])->onlyInput('email');                
                 
        } 
        
        request()->session()->regenerate();
        return redirect()->intended(route('usuarios.index'));

    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login.index');
    }
}
 