<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$peliculasAll = Pelicula::with('calidad')->with('relacion')->get();
        $peliculasAll = Pelicula::all();
        return response()->json($peliculasAll);
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
        $validar = Validator::make($request->json()->all(),[
            "nombre"=> ['required', 'string'],
            "ano"=>['required', 'date'],
            'calificacion_rotten'=>['required','integer'],
            'calificacion_IMDB'=>['required','integer'],
            'director'=>['required','string'],
            'video_trailer'=>['required','string'],
            'sinopsis'=>['required','string'],
            'genero'=>['required','string'],

        ]);

        if ($validar->fails()) {
            return response()->json($validar->messages(), Response::HTTP_BAD_REQUEST);
        }
        $pelicula = new Pelicula($request->json()->all());
        $pelicula->save();

        return response()->json($pelicula);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pelicula = Pelicula::with('calidad')->with('relacion')->where('id', '=', $id)->get();
        if ($pelicula == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($pelicula);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelicula $pelicula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::find($id);
        if ($pelicula == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validar = Validator::make($request->json()->all(),[
                "nombre"=> ['required', 'string'],
                "ano"=>['required', 'date'],
                'calificacion_rotten'=>['required','integer'],
                'calificacion_IMDB'=>['required','integer'],
                'director'=>['required','string'],
                'video_trailer'=>['required','string'],
                'sinopsis'=>['required','string'],
                'genero'=>['required','string'],
            ]);
        } else {
            $validar = Validator::make($request->json()->all(),[
                "nombre"=> ['required', 'string'],
                "ano"=>['required', 'string'],
                'calificacion_rotten'=>['required','integer'],
                'calificacion_IMDB'=>['required','integer'],
                'director'=>['required','string'],
                'video_trailer'=>['required','string'],
                'sinopsis'=>['required','string'],
                'genero'=>['required','string'],

            ]);
        }
        if ($validar->fails()) {
            return response()->json($validar->messages(), Response::HTTP_BAD_REQUEST);
        }
        $pelicula->fill($request->json()->all());
        $pelicula->save();
        return response()->json($pelicula);
    }
    /*
     * Subir imagen de pelicula
     * */
    public function subirImagenPelicula(Request $request, $id){
        $objpelicula = Pelicula::find($id);
        if ($objpelicula == null){
            return response()->json(array(
                "menssage" => "Item not fount"
            ), Response::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('img')){
            $file = $request->file('img');
            $imgName = $id . ".png";
            $file->move(public_path("imagen/pelicula"), $imgName);

            return response()->json([
                "res" => "success"
            ]);
        }

        return response()->json([
            "message" => "Image not found"
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $pelicula = Pelicula::find($id);
        if ($pelicula == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $pelicula->delete();
        return response()->json(['success' => true]);
    }
}
