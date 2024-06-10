<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['contactos']=Contacto::paginate(5);
        return view('contacto.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacto.create');
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

        $datosContacto = request()->except('_token');
        Contacto::insert($datosContacto);
        return redirect('contacto')->with('mensaje','Contacto Agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigocontacto)
    {
        $contacto = Contacto::findOrFail($codigocontacto);
        return view('contacto.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigocontacto)
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

        $datosContacto = request()->except(['_token', '_method']);
        Contacto::where('codigocontacto', '=', $codigocontacto)-> update($datosContacto);

        $contacto = Contacto::findOrFail($codigocontacto);
        return redirect('contacto')->with('mensaje','Contacto Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigocontacto)
    {
        Contacto::destroy($codigocontacto);
        return redirect('contacto')->with('mensaje','Contacto Borrado');
    }
}
