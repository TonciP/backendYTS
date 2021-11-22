<?php

namespace App\Http\Controllers;

use App\Models\PeliculaRelacion;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeliculaRelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listaPeliculaRelacion = PeliculaRelacion::with('relacion')->get();
        return response()->json($listaPeliculaRelacion);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator($request->json()->all(),[
            'pertenece_pelicula_id'=>'required|integer',
            'pelicula_id'=>'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $peliculaRelacion = new PeliculaRelacion($request->json()->all());
        $peliculaRelacion->save();

        return response()->json($request->json()->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeliculaRelacion  $peliculas_Relacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $peliculas_Relacion = PeliculaRelacion::find($id);
        if ($peliculas_Relacion == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($peliculas_Relacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeliculaRelacion  $peliculas_Relacion
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function ByIdPeliculaPertenece($id)
    {
        $peliculas_Relacion = PeliculaRelacion::with('relacion')->where('pertenece_pelicula_id','=',$id)->get();
        if ($peliculas_Relacion == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($peliculas_Relacion);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeliculaRelacion  $peliculas_Relacion
     * @return \Illuminate\Http\Response
     */
    public function edit(PeliculaRelacion $peliculas_Relacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeliculaRelacion  $peliculas_Relacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $peliculas_Relacion = PeliculaRelacion::find($id);
        if ($peliculas_Relacion == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator($request->json()->all(),[
                'pertenece_pelicula_id'=>'required|integer',
                'pelicula_id'=>'required|integer'
            ]);
        } else {
            $validator = Validator($request->json()->all(),[
                'pertenece_pelicula_id'=>'required|integer',
                'pelicula_id'=>'required|integer'
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $peliculas_Relacion->fill($request->json()->all());
        $peliculas_Relacion->save();
        return response()->json($peliculas_Relacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeliculaRelacion  $peliculas_Relacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $peliculas_Relacion = PeliculaRelacion::find($id);
        if ($peliculas_Relacion == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $peliculas_Relacion->delete();
        return response()->json(['success' => true]);
    }
}
