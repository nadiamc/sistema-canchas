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
        // 1. Validaciones del lado del servidor (Requisito UTN)
        $request->validate([
            'cancha_id'   => 'required|exists:canchas,id',
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio',
        ]);

        $datos = $request->all();
        $datos['user_id'] = Auth::id();
        
        // 2. Buscamos la cancha para conocer su precio por hora
        $cancha = Cancha::findOrFail($request->cancha_id);

        // 3. Calculamos la diferencia en horas usando la herramienta Carbon de Laravel
        $inicio = \Carbon\Carbon::parse($request->hora_inicio);
        $fin = \Carbon\Carbon::parse($request->hora_fin);
        
        // Trae la diferencia en horas (por ejemplo: 1.5 si jugaron hora y media)
        $horasDeReserva = $inicio->diffInMinutes($fin) / 60;

        // 4. Multiplicamos el tiempo por el precio por hora de esa cancha
        $datos['total'] = $horasDeReserva * $cancha->precio_hora; 

        // 5. Creamos la reserva con el total real calculado
        Reserva::create($datos);

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
        // 1. Validamos que los datos modificados cumplan las reglas
        $request->validate([
            'cancha_id'   => 'required|exists:canchas,id', 
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio'
        ]);

        $datos = $request->all();

        // 2. Buscamos la cancha (útil por si el usuario cambió de cancha al editar)
        $cancha = Cancha::findOrFail($request->cancha_id);

        // 3. Recalculamos el tiempo con Carbon
        $inicio = \Carbon\Carbon::parse($request->hora_inicio);
        $fin = \Carbon\Carbon::parse($request->hora_fin);
        $horasDeReserva = $inicio->diffInMinutes($fin) / 60;

        // 4. Actualizamos el nuevo total
        $datos['total'] = $horasDeReserva * $cancha->precio_hora;

        // 5. Impactamos los cambios en la base de datos
        $reserva->update($datos);

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