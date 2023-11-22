<?php

namespace App\Http\Controllers;

use App\Models\Mesas;
use Illuminate\Http\Request;
use App\Models\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrdenControlador extends Controller
{
    public function guardarCompra(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'cart' => 'required|json',
                'mesa_id' => 'required|numeric', // Agregar validación para mesa_id
            ]);
    
            // Obtener el valor de la mesa escaneada desde el cuerpo de la solicitud
            $mesaEscaneada = $request->input('mesa_id');
    
            // Obtener y decodificar el carrito desde la solicitud
            $cart = json_decode($request->input('cart'), true);
    
            // Calcular el total sumando los precios de todos los productos en el carrito
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['precio'] * $item['cantidad']);
            }, 0);
    
            // Obtener el usuario actualmente autenticado
            $usuarioId = auth()->user()->id;
    
            // Crear la orden
            $orden = new Orden([
                'usuario_id' => $usuarioId,
                'carrito' => json_encode($cart),
                'cantidad' => $total,
                'mesas_id' => $mesaEscaneada, // Asignar el valor directamente
            ]);
    
            $orden->save();
            $request->session()->forget('cart');
    
            // Redirigir o devolver la respuesta adecuada
            return redirect('/')->with('success', 'La Compra Se Realizó con Éxito');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect('/')->with('error', 'Hubo un Error al Realizar la Compra: ' . $e->getMessage());
        }
    }
    public function mostrarOrden()
    {
        // Obtén el ID del usuario autenticado
        $usuarioId = Auth::id();

        // Obtén las órdenes del usuario actual ordenadas por la fecha de creación
        $ordenes = Orden::where('usuario_id', $usuarioId)->latest()->get();

        return view('orden.historial', compact('ordenes'));
    }

    public function mostrarHistorialAdmin()
    {
        // Obtener todas las órdenes ordenadas por la fecha de creación (la más reciente primero)
        $ordenes = Orden::with('usuario')->latest()->get();

        return view('orden.realizado', compact('ordenes'));
    }
}