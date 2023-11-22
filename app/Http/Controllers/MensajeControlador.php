<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;

class MensajeControlador extends Controller
{
    public function index(){

        $mensaje = Mensaje::all();
        return view('mensaje.mostrar', compact('mensaje'));
    }
    public function contacto(){

        return view('mensaje.contacto');
    }
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'mensaje' => 'required|string|max:255',
        ]);
    
        // Crear un nuevo mensaje con el usuario autenticado
        $mensaje = new Mensaje([
            'mensaje' => $request->input('mensaje'),
        ]);
    
        // Asociar el usuario autenticado al mensaje
        $user = auth()->user();
    
        if ($user) {
            $mensaje->usuario_id = $user->id;
        } else {
            // Manejar el caso en el que no hay usuario autenticado (opcional)
            // Por ejemplo, podrías redirigir a la página de inicio de sesión
            return redirect()->back()->with('error', 'Debes iniciar sesión para enviar un mensaje');
        }
    
        // Guardar el mensaje en la base de datos
        $mensaje->save();
    
        // Puedes redirigir o devolver una respuesta según tus necesidades
        return redirect()->back()->with('mensaje', '¡El mensaje ha sido enviado con éxito!');
    }
    public function destroy($id){
        
        $mensaje = Mensaje::find($id);

        $mensaje->delete();

        return redirect()->route('mensaje.index');
    }
}
