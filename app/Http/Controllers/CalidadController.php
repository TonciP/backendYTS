<?php

namespace App\Http\Controllers;

use App\Models\Calidad;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $listacalidad = calidad::all();
        return response()->json($listacalidad);
    }    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
 */
    public function peliculaCalidad()
    {
        $listacalidad = calidad::with('pelicula')->get();
        return response()->json($listacalidad);
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
            'formato'=>'required|string',
            'nivel'=>'required|integer',
            'peli_id'=>'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $calidad = new Calidad($request->json()->all());
        $calidad->save();

        return response()->json($calidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calidad  $calidad
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $calidad = Calidad::with('pelicula')->where('id','=',$id)->get();
        if ($calidad == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($calidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calidad  $calidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Calidad $calidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calidad  $calidad
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $calidad = Calidad::find($id);
        if ($calidad == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator([
                'formato'=>'required|string',
                'nivel'=>'required|integer',
                'peli_id'=>'required|integer'
            ]);
        } else {
            $validator = Validator([
                'formato'=>'required|string',
                'nivel'=>'required|integer',
                'peli_id'=>'required|integer'
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $calidad->fill($request->json()->all());
        $calidad->save();
        return response()->json($calidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calidad  $calidad
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $calidad = Calidad::find($id);
        if ($calidad == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $calidad->delete();
        return response()->json(['success' => true]);
    }
}
