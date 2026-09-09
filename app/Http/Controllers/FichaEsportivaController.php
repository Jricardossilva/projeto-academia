<?php

namespace App\Http\Controllers;

use App\Models\FichaEsportiva;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
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
        return view('fichas-esportivas.create', [
            'usuarios' => Usuario::all()
        ]);
    }

    public function store(Request $request)
    {
        FichaEsportiva::create($request->all());
        return redirect()->route('fichas-esportivas.index');
    }

    public function edit(FichaEsportiva $ficha)
    {
        return view('fichas-esportivas.edit', [
            'ficha' => $ficha,
            'usuarios' => Usuario::all()
        ]);
    }

    public function update(Request $request, FichaEsportiva $ficha)
    {
        $ficha->update($request->all());
        return redirect()->route('fichas-esportivas.index');
    }
    
    public function destroy(FichaEsportiva $ficha)
    {
        $ficha->delete();
        return redirect()->route('fichas-esportivas.index');
    }
}
