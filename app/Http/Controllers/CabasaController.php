<?php

namespace App\Http\Controllers;
use App\Cabasa;
use Illuminate\Http\Request;
use App\Http\Resources\Cabasa as CabasaResource;
use App\Http\Requests;

class CabasaController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    // the index method will return all the data in the database
    public function index()
    {
        $cabasas = Cabasa::all();
        return CabasaResource::collection($cabasas);
    }

    // the method below gets the an individual ite from the database
    public function show($id)
    {
        $cabasa = Cabasa::findOrFail($id);                    // Get individual item (id)
        return new CabasaResource($cabasa);                 // return single article as a resource
    }


    // The method below store/post/insert data into the data base and also edit/put function
    public function store(Request $request)
    {
        $cabasa = $request->isMethod('put') ? Cabasa::findOrFail($request->cabasa_id) : new Cabasa;

        $cabasa->id = $request->input('cabasa_id');
        $cabasa->hallName = $request->input('hallName');
        $cabasa->capacity = $request->input('capacity');
        $cabasa->reason = $request->input('reason');
        $cabasa->status = $request->input('status');

        if ($cabasa->save()) {
            return new CabasaResource($cabasa);
        }
    }


    // the method below will delete an ietm from the database by it id
    public function destroy($id)
    {
        $cabasa = Cabasa::findOrFail($id);                  // Get individual item (id) and thus delete the item whose id is refferenced
        if ($cabasa->delete()) {
            return new CabasaResource($cabasa);
        }
    }

}//
