<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;


class ProductosControlador extends Controller
{
    public function index(){

        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }
    public function create(){
        return view('productos.crear');
    }
    public function store( Request $request){

        $producto = new Producto();

        //dd($request->hasfile('pictures'));
        if($request->hasfile('imagen')){
            $file=$request->file('imagen');
            $destino ='images/';
            $filename=time()."-".$file->getClientOriginalName();
            $uploadSuccess=$request->file('imagen')->move($destino,$filename);
            $producto->imagen = $destino . $filename;
        }

        $producto->nombre=$request->nombre;
        $producto->categoria=$request->categoria;
        $producto->precio=$request->precio;
        $producto->descripcion=$request->descripcion;

        $producto->save();

        return redirect()->route('productos.index');

    }
    public function edit($id){

        $producto= Producto::find($id);

        return view('productos.editar', compact('producto'));
    }
    //public function update(Request $request, $id){

      //  $producto = Producto::find($id);
     //   $producto ->update($request->all());

        
      //  return redirect()->route('productos.index');
   // }
    public function destroy($id){
        
        $producto = Producto::find($id);

        $producto->delete();

        return redirect()->route('productos.index');
    }
    public function compras(){

        $productos = Producto::all();
        return view('productos.mostrar', compact('productos'));
    }

    public function contacto(){

        return view('productos.contacto');
    }
    public function nosotros(){

        return view('productos.nosotros');
    }
    public function cart(){
        return view('productos.cart');
    }
    public function añadirCarrito($id)
    {
       
        if (Auth::check()) {
            $producto = Producto::findOrFail($id);
    
            $carrito = session()->get('cart', []);
    
            if (isset($carrito[$id])) {
                $carrito[$id]['cantidad']++;
            } else {
                $carrito[$id] = [
                    "nombre" => $producto->nombre,
                    "categoria" => $producto->categoria,
                    "imagen" => $producto->imagen,
                    "descripcion" => $producto->descripcion,
                    "precio" => $producto->precio,
                    "cantidad" => 1
                ];
            }
    
            session()->put('cart', $carrito);
    
            return redirect()->back()->with('success', 'Producto añadido al carrito');
        } else {
            return redirect()->back()->with('error', 'Debes iniciar sesión para agregar productos al carrito');
        }
    }
   public function update(Request $request)
   {
       if($request->id && $request->cantidad){
           $cart = session()->get('cart');
           $cart[$request->id]["cantidad"] = $request->cantidad;
           session()->put('cart', $cart);
           session()->flash('success', '¡Carrito actualizado con éxito!');
       }
   }
 
   public function remove(Request $request)
   {
       if($request->id) {
           $cart = session()->get('cart');
           if(isset($cart[$request->id])) {
               unset($cart[$request->id]);
               session()->put('cart', $cart);
           }
           session()->flash('success', '¡El producto se ha eliminado con éxito!');
       }
   }
}
