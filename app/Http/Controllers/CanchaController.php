<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use Illuminate\Http\Request;

class CanchaController extends Controller
{
    public function index()
    {
        $canchas = Cancha::all();
        return view('canchas.index', compact('canchas'));
    }

    public function create()
    {
        return view('canchas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'tipo'        => 'required|string',
            'precio_hora' => 'required|numeric|min:0'
        ]);

        // ✅ ARREGLADO
        Cancha::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'precio_hora' => (float) $request->precio_hora,
        ]);

        return redirect()->route('canchas.index')
                         ->with('success', 'Cancha creada con éxito.');
    }

    public function edit(Cancha $cancha)
    {
        return view('canchas.edit', compact('cancha'));
    }

    public function update(Request $request, Cancha $cancha)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'tipo'        => 'required|string',
            'precio_hora' => 'required|numeric|min:0'
        ]);

        // ✅ ARREGLADO
        $cancha->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'precio_hora' => (float) $request->precio_hora,
        ]);

        return redirect()->route('canchas.index')
                         ->with('success', 'Cancha actualizada con éxito.');
    }

    public function destroy(Cancha $cancha)
    {
        $cancha->delete();

        return redirect()->route('canchas.index')
                         ->with('success', 'Cancha eliminada con éxito.');
    }
}