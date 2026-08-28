<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichaEsportivaController extends Controller
{
    public function index()
    {
        $fichas = FichaEsportiva::all();
        return view('fichas.index', compact('fichas'));
    }

    public function store(Request $request)
    {
        FichaEsportiva::create($request->all());
        return redirect()->route('fichas.index');
    }
}
