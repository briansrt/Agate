<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['clientes']=Cliente::paginate(5);
        return view('cliente.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos=[
            'nombre'=> 'required|string|max:100',
            'apellido'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'celular'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'direccion.required'=> 'La direccion es requerida'
            
        ];
        $this->validate($request, $campos, $mensaje);

        $datosCliente = request()->except('_token');
        Cliente::insert($datosCliente);
        return redirect('cliente')->with('mensaje','Cliente Agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigocliente)
    {
        $cliente = Cliente::findOrFail($codigocliente);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigocliente)
    {

        $campos=[
            'nombre'=> 'required|string|max:100',
            'apellido'=> 'required|string|max:100',
            'direccion'=> 'required|string|max:100',
            'celular'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'direccion.required'=> 'La direccion es requerida'
            
        ];
        $this->validate($request, $campos, $mensaje);

        $datosCliente = request()->except(['_token', '_method']);
        Cliente::where('codigocliente', '=', $codigocliente)-> update($datosCliente);

        $cliente = Cliente::findOrFail($codigocliente);
        return redirect('cliente')->with('mensaje','Cliente Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigocliente)
    {
        Cliente::destroy($codigocliente);
        return redirect('cliente')->with('mensaje','Cliente Borrado');
    }
}
