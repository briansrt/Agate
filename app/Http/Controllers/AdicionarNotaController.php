<?php

namespace App\Http\Controllers;

use App\Models\AdicionarNota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Campaña;
use App\Models\Anuncio;

class AdicionarNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['adicionarnotas']=AdicionarNota::paginate(5);
        return view('adicionarnota.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $campañas = Campaña::all();
        $anuncios = Anuncio::all();
        return view('adicionarnota.create', compact('clientes', 'campañas', 'anuncios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigoanuncio' => 'required|exists:anuncios,codigoanuncio',
            'fecha'=> 'required|date',
            'nota'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'descripcion.required'=> 'La descripcion es requerida',
            'fecha.required'=> 'La fecha es requerida',
            'nota.required'=> 'La nota es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAdicionarNota = request()->except('_token');
        AdicionarNota::insert($datosAdicionarNota);
        return redirect('adicionarnota')->with('mensaje','Nota Agregado a Anuncio con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdicionarNota $adicionarNota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigoadicionarnotas)
    {
        $adicionarnota = AdicionarNota::findOrFail($codigoadicionarnotas);
        $clientes = Cliente::all();
        $campañas = Campaña::where('codigocliente', $adicionarnota->codigocliente)->get();
        $anuncios = Anuncio::where('codigocampana', $adicionarnota->codigocampana)->get();
        return view('adicionarnota.edit', compact('adicionarnota', 'clientes', 'campañas', 'anuncios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigoadicionarnotas)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigoanuncio' => 'required|exists:anuncios,codigoanuncio',
            'fecha'=> 'required|date',
            'nota'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'fecha.required'=> 'La fecha es requerida',
            'nota.required'=> 'La nota es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAdicionarNota = request()->except(['_token', '_method']);
        AdicionarNota::where('codigoadicionarnotas', '=', $codigoadicionarnotas)-> update($datosAdicionarNota);

        $adicionarnota = AdicionarNota::findOrFail($codigoadicionarnotas);
        return redirect('adicionarnota')->with('mensaje','Nota Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigoadicionarnotas)
    {
        AdicionarNota::destroy($codigoadicionarnotas);
        return redirect('adicionarnota')->with('mensaje','Nota Borrado');
    }
}
