<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaEsportiva;

class FichaEsportivaController extends Controller
{
    public function index(Request $request)
    {
        $query = FichaEsportiva::with('usuario');

        if ($request->filled('nivel')) {
            $query->where('nivel_experiencia', $request->nivel);
        }

        return view('fichas-esportivas.index', ['fichas' => $query->get()]);
    }   

    public function store(Request $request)
    {
        FichaEsportiva::create($request->all());
        return redirect()->route('fichas.index');
    }
}
