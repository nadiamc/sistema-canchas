<?php

namespace App\Http\Controllers;

// Importamos el Modelo Cancha para poder interactuar con la tabla de la base de datos
use App\Models\Cancha;
// Importamos Request para recibir los datos que viajan desde los formularios
use Illuminate\Http\Request;

class CanchaController extends Controller
{
    /**
     * Muestra el listado completo de las canchas (READ del CRUD).
     */
    public function index()
    {
        // El ORM Eloquent busca todos los registros en la tabla 'canchas'
        $canchas = Cancha::all();
        
        // Retorna la vista 'index' dentro de la carpeta 'views/canchas'
        // 'compact' empaqueta la variable $canchas para poder usarla en el Blade
        return view('canchas.index', compact('canchas'));
    }

    /**
     * Muestra la pantalla del formulario para dar de alta una cancha (CREATE).
     */
    public function create()
    {
        // Retorna la vista con el formulario de carga
        return view('canchas.create');
    }

    /**
     * Recibe los datos del formulario de creación y los guarda en la base de datos (STORE).
     */
    public function store(Request $request)
    {
        // Validaciones obligatorias del lado del servidor)
        $request->validate([
            'nombre'      => 'required|string|max:255', // El nombre no puede estar vacío y es texto
            'tipo'        => 'required|string',          // El tipo (fútbol, paddle, etc.) es obligatorio
            'precio_hora' => 'required|numeric|min:0'    // El precio debe ser un número positivo
        ]);

        // Guarda de forma masiva en la base de datos (usa la propiedad $fillable del Modelo Cancha)
        Cancha::create($request->all());

        // Redirecciona al usuario al listado general de canchas
        // 'with' envía una variable de sesión flash llamada 'success' con el mensaje de éxito
        return redirect()->route('canchas.index')->with('success', 'Cancha creada con éxito.');
    }

    /**
     * Muestra el formulario para editar una cancha específica (EDIT).
     * Laravel usa "Route Model Binding" e inyecta directamente la cancha según el ID que viene en la URL.
     */
    public function edit(Cancha $cancha)
    {
        // Retorna la vista de edición pasándole los datos actuales de esa cancha para precargarlos
        return view('canchas.edit', compact('cancha'));
    }

    /**
     * Recibe los datos modificados del formulario de edición y actualiza la base de datos (UPDATE).
     */
    public function update(Request $request, Cancha $cancha)
    {
        // Volvemos a validar que el usuario no haya dejado campos obligatorios vacíos al editar
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'tipo'        => 'required|string',
            'precio_hora' => 'required|numeric|min:0'
        ]);

        // Actualiza el registro de esta cancha en particular con los nuevos datos recibidos
        $cancha->update($request->all());

        // Redirecciona al listado avisando que se modificó correctamente
        return redirect()->route('canchas.index')->with('success', 'Cancha actualizada con éxito.');
    }

    /**
     * Elimina una cancha de la base de datos (DESTROY - Eliminación física).
     */
    public function destroy(Cancha $cancha)
    {
        // Borra el registro seleccionado de la base de datos
        $cancha->delete();
        
        // Redirecciona al listado refrescado avisando de la eliminación
        return redirect()->route('canchas.index')->with('success', 'Cancha eliminada con éxito.');
    }
}