<?php

namespace App\Http\Controllers;

use App\Models\Campaña;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Contacto;

class CampañaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['campañas']=Campaña::paginate(5);
        return view('campaña.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $contactos = Contacto::all();
        return view('campaña.create', compact('clientes', 'contactos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocontacto' => 'required|exists:contactos,codigocontacto',
            'descripcion'=> 'required|string|max:100',
            'presupuesto'=> 'required|integer',
            'fechainicio'=> 'required|date',
            'fechafin'=> 'required|date',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'descripcion.required'=> 'La descripcion es requerida',
            'fechainicio.required'=> 'La fecha de inicio es requerida',
            'fechafin.required'=> 'La fecha de fin es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosCampaña = request()->except('_token');
        Campaña::insert($datosCampaña);
        return redirect('campaña')->with('mensaje','Campaña Agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistroPago $registroPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigocampana)
    {
        $campaña = Campaña::findOrFail($codigocampana);
        $clientes = Cliente::all();
        $contactos = Contacto::all();
        return view('campaña.edit', compact('campaña', 'clientes', 'contactos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigocampana)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocontacto' => 'required|exists:contactos,codigocontacto',
            'descripcion'=> 'required|string|max:100',
            'presupuesto'=> 'required|integer',
            'fechainicio'=> 'required|date',
            'fechafin'=> 'required|date',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'descripcion.required'=> 'La descripcion es requerida',
            'fechainicio.required'=> 'La fecha de inicio es requerida',
            'fechafin.required'=> 'La fecha de fin es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosCampaña = request()->except(['_token', '_method']);
        Campaña::where('codigocampana', '=', $codigocampana)-> update($datosCampaña);

        $campaña = Campaña::findOrFail($codigocampana);
        return redirect('campaña')->with('mensaje','Campaña Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigocampana)
    {
        Campaña::destroy($codigocampana);
        return redirect('campaña')->with('mensaje','Campaña Borrado');
    }

    public function CampañaPorCliente($codigocliente)
    {
        $campañas = Campaña::where('codigocliente', $codigocliente)->get();
        return response()->json($campañas);
    }

}