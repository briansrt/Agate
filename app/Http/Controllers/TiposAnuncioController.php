<?php

namespace App\Http\Controllers;

use App\Models\TiposAnuncio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiposAnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['tiposanuncios']=TiposAnuncio::paginate(5);
        return view('tiposanuncio.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiposanuncio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'nombre'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);

        $datosTiposAnuncio = request()->except('_token');
        TiposAnuncio::insert($datosTiposAnuncio);
        return redirect('tiposanuncio')->with('mensaje','El Tipo de Anuncio se ha agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(TiposAnuncio $tiposAnuncio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($codigotiposanuncio)
    {
        $tiposanuncio = TiposAnuncio::findOrFail($codigotiposanuncio);
        return view('tiposanuncio.edit', compact('tiposanuncio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigotiposanuncio)
    {
        $campos=[
            'nombre'=> 'required|string|max:100',
        ];
        $mensaje =[
            'required'=>'El :attribute es requerido',
            
        ];
        $this->validate($request, $campos, $mensaje);

        $datosTiposAnuncio = request()->except(['_token', '_method']);
        TiposAnuncio::where('codigotiposanuncio', '=', $codigotiposanuncio)-> update($datosTiposAnuncio);

        $tiposanuncio = TiposAnuncio::findOrFail($codigotiposanuncio);
        return redirect('tiposanuncio')->with('mensaje','Tipo de Anuncio actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codigotiposanuncio)
    {
        TiposAnuncio::destroy($codigotiposanuncio);
        return redirect('tiposanuncio')->with('mensaje','Tipo de Anuncio Borrado');
    }
}
