<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Mesas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MesasControlador extends Controller
{
    public function index(){

        $mesas = Mesas::all();
        return view('mesas.index', compact('mesas'));
    }
    public function create(){
        return view('mesas.crear');
    }
   
    public function generar_qr(){
       return QrCode::generate('Make me into a QrCode!');
    }
    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'codigo' => 'required',
                'nombre' => 'required',
                'estado' => 'required',
                'capacidad' => 'required|integer|min:1',
            ]);
    
            // Crear una nueva instancia del modelo Mesas
            $mesa = new Mesas();
    
            // Asignar los valores desde la solicitud
            $mesa->fill($request->only(['codigo','nombre', 'estado', 'capacidad']));
    
            // Generar el código QR y obtener la ruta
            $qrContent = QrCode::format('png')->size(200)->generate($request->codigo);
            $destino = 'qrcodes/';
            $filename = 'qr_' . time() . '.png';
    
            // Construir la ruta completa del código QR
            $qrPath = public_path($destino . $filename);
    
            // Almacenar el contenido del código QR en la carpeta 'public/qrcodes'
            file_put_contents($qrPath, $qrContent);
    
            // Actualizar la columna 'qr' en la base de datos con la ruta del archivo
            $mesa->qr = $destino . $filename;
            $mesa->save();
    
            // Redirigir a la ruta 'mesas.index'
            return redirect()->route('mesas.index')->with('success', 'Mesa creada exitosamente.');
        } catch (\Exception $e) {
            // Capturar excepciones y mostrar mensaje de error
            return redirect()->route('mesas.index')->with('error', 'Error al crear la mesa: ' . $e->getMessage());
        }
    }
    public function qrcode(){
        return view('mesas.qrcode');
    }
    public function destroy($id){
        
        $mesa = Mesas::find($id);

        $mesa->delete();

        return redirect()->route('mesas.index');
    }
    public function descargarQR($id)
    {
    try {
        $mesa = Mesas::findOrFail($id);

        // Obtener la ruta completa del archivo QR
        $qrPath = public_path($mesa->qr);

        // Descargar el archivo
        return response()->download($qrPath);
    } catch (\Exception $e) {
        // Manejar la excepción si la mesa no se encuentra o hay otros errores
        return redirect()->route('mesas.index')->with('error', 'Error al descargar el QR: ' . $e->getMessage());
    }
}

public function buscarIdDeMesa(Request $request)
{
    try {
        // Obtener el nombre de la mesa escaneada desde la solicitud
        $nombreMesaEscaneada = $request->query('nombre');

        // Buscar la mesa por el nombre en la base de datos
        $mesa = Mesas::where('nombre', $nombreMesaEscaneada)->first();

        // Verificar si la mesa fue encontrada
        if ($mesa) {
            // Obtener el ID de la mesa
            $mesaId = $mesa->id;

            // Devolver el ID de la mesa como respuesta JSON
            return response()->json(['id' => $mesaId]);
        } else {
            // Manejar el caso en el que la mesa no fue encontrada
            return response()->json(['error' => 'La mesa no fue encontrada en la base de datos'], 404);
        }
    } catch (\Exception $e) {
        // Log de la excepción
        Log::error('Error durante la búsqueda de la mesa: ' . $e->getMessage());

        // Devolver una respuesta de error
        return response()->json(['error' => 'Error interno del servidor'], 500);
    }
}
}
        
    
