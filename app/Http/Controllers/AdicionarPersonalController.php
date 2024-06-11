<?php

namespace App\Http\Controllers;

use App\Models\AdicionarPersonal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Campaña;
use App\Models\Contacto;

class AdicionarPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['adicionarpersonals']=AdicionarPersonal::paginate(5);
        return view('adicionarpersonal.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $campañas = Campaña::all();
        $contactos = Contacto::all();
        return view('adicionarpersonal.create', compact('clientes', 'campañas', 'contactos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigocontacto' => 'required|exists:contactos,codigocontacto',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAdicionarPersonal = request()->except('_token');
        AdicionarPersonal::insert($datosAdicionarPersonal);
        return redirect('adicionarpersonal')->with('mensaje','Personal Agregado a Campaña con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdicionarPersonal $adicionarPersonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigoadicionarpersonal)
    {
        $adicionarpersonal = AdicionarPersonal::findOrFail($codigoadicionarpersonal);
        $clientes = Cliente::all();
        $campañas = Campaña::where('codigocliente', $adicionarpersonal->codigocliente)->get();
        $contactos = Contacto::all();
        return view('adicionarpersonal.edit', compact('adicionarpersonal', 'clientes', 'campañas', 'contactos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigoadicionarpersonal)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigocontacto' => 'required|exists:contactos,codigocontacto',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAdicionarPersonal = request()->except(['_token', '_method']);
        AdicionarPersonal::where('codigoadicionarpersonal', '=', $codigoadicionarpersonal)-> update($datosAdicionarPersonal);

        $adicionarpersonal = AdicionarPersonal::findOrFail($codigoadicionarpersonal);
        return redirect('adicionarpersonal')->with('mensaje','Personal Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigoadicionarpersonal)
    {
        AdicionarPersonal::destroy($codigoadicionarpersonal);
        return redirect('adicionarpersonal')->with('mensaje','Personal Borrado');
    }
}
