<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Campaña;
use App\Models\TiposAnuncio;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['anuncios']=Anuncio::paginate(5);
        return view('anuncio.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $campañas = Campaña::all();
        $tiposanuncios = TiposAnuncio::all();
        return view('anuncio.create', compact('clientes', 'campañas', 'tiposanuncios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigotiposanuncio' => 'required|exists:tipos_anuncios,codigotiposanuncio',
            'descripcion'=> 'required|string|max:100',
            'fechainicio'=> 'required|date',
            'fechafin'=> 'required|date',
            'valor'=> 'required|integer',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'descripcion.required'=> 'La descripcion es requerida',
            'fechainicio.required'=> 'La fecha de inicio es requerida',
            'fechafin.required'=> 'La fecha de fin es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAnuncio = request()->except('_token');
        Anuncio::insert($datosAnuncio);
        return redirect('anuncio')->with('mensaje','Anuncio Agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anuncio $anuncio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigoanuncio)
    {
        $anuncio = Anuncio::findOrFail($codigoanuncio);
        $clientes = Cliente::all();
        $campañas = Campaña::where('codigocliente', $anuncio->codigocliente)->get();
        $tiposanuncios = TiposAnuncio::all();
        return view('anuncio.edit', compact('anuncio', 'clientes', 'campañas', 'tiposanuncios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigoanuncio)
    {
        $campos=[
            'codigocliente' => 'required|exists:clientes,codigocliente',
            'codigocampana' => 'required|exists:campañas,codigocampana',
            'codigotiposanuncio' => 'required|exists:tipos_anuncios,codigotiposanuncio',
            'descripcion'=> 'required|string|max:100',
            'fechainicio'=> 'required|date',
            'fechafin'=> 'required|date',
            'valor'=> 'required|integer',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            'descripcion.required'=> 'La descripcion es requerida',
            'fechainicio.required'=> 'La fecha de inicio es requerida',
            'fechafin.required'=> 'La fecha de fin es requerida',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosAnuncio = request()->except(['_token', '_method']);
        Anuncio::where('codigoanuncio', '=', $codigoanuncio)-> update($datosAnuncio);

        $anuncio = Anuncio::findOrFail($codigoanuncio);
        return redirect('anuncio')->with('mensaje','Anuncio Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigoanuncio)
    {
        Anuncio::destroy($codigoanuncio);
        return redirect('anuncio')->with('mensaje','Anuncio Borrado');
    }

    public function AnuncioPorCampaña($codigocampana)
    {
        $anuncios = Anuncio::where('codigocampana', $codigocampana)->get();
        return response()->json($anuncios);
    }
}
