<?php

namespace App\Http\Controllers;
use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::all();
        
        return view('exercicios.index', compact('exercicios'));
    }

    public function store(Request $request)
    {
        Exercicio::create($request->all());
        return redirect()->route('exercicios.index');
    }
}
