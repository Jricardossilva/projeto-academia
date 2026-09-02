<?php

namespace App\Http\Controllers;

use App\Models\FichaEsportiva;
use Illuminate\Http\Request;

class FichaEsportivaController extends Controller
{
    public function index(Request $request)
    {
        $query = FichaEsportiva::with('usuario');

        if ($request->filled('nivel')) {
            
            $query->where('nivel_experiencia', $request->nivel);
        }

        return view('fichas-esportivas.index', ['fichas' => $query->get() ?? []]);
    }   

    public function create()
    {
        return view('fichas-esportivas.create');
    }

    public function store(Request $request)
    {
        FichaEsportiva::create($request->all());
        return redirect()->route('fichas.index');
    }
}
