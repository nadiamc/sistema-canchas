<?php

namespace App\Http\Controllers;

// Importamos los modelos necesarios para interactuar con las tablas
use App\Models\Reserva;
use App\Models\Cancha;
use Illuminate\Http\Request;
// Importamos la fachada Auth para saber qué usuario está logueado
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Muestra el listado de reservas con su tabla relacionada (READ).
     */
    public function index()
    {
        // Requisito UTN: Usamos 'with' para traer la relación y mostrar datos de la cancha asociada
        $reservas = Reserva::with(['cancha', 'user'])->get();
        
        // Retorna la vista index de reservas pasándole la lista
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Muestra el formulario para crear una nueva reserva (CREATE).
     */
    public function create()
    {
        // Traemos solo las canchas disponibles para que el usuario pueda elegir una en el formulario
        $canchas = Cancha::where('disponible', true)->get();
        
        return view('reservas.create', compact('canchas'));
    }

    /**
     * Guarda la reserva validando los datos del formulario (STORE).
     */
    public function store(Request $request)
    {
        // Validaciones del lado del servidor (Requisito UTN)
        $request->validate([
            'cancha_id'   => 'required|exists:canchas,id', // Debe existir en la tabla canchas
            'fecha'       => 'required|date|after_or_equal:today', // No se puede reservar el pasado
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio', // La hora de fin debe ser posterior
        ]);

        // Clonamos los datos que vienen del formulario
        $datos = $request->all();
        
        // Capturamos el ID del usuario autenticado en el sistema de forma automática y segura
        $datos['user_id'] = Auth::id();
        
        // Por ahora fijamos un total por defecto para que no falle la base de datos 
        // (Luego lo podemos automatizar multiplicando el precio de la cancha por las horas)
        $datos['total'] = 0.00; 

        // Creamos la reserva en la base de datos
        Reserva::create($datos);

        // Redirecciona con un mensaje flash de éxito
        return redirect()->route('reservas.index')->with('success', '¡Reserva registrada con éxito!');
    }

    /**
     * Muestra el formulario para editar una reserva existente (EDIT).
     */
    public function edit(Reserva $reserva)
    {
        $canchas = Cancha::all();
        return view('reservas.edit', compact('reserva', 'canchas'));
    }

    /**
     * Actualiza los datos de la reserva modificada (UPDATE).
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio'
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Cancela o elimina una reserva (DESTROY).
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}