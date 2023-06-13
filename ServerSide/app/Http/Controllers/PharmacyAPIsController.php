<?php

namespace App\Http\Controllers;

use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PharmacyAPIsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return PharmacyResource::collection(Pharmacy::all());
//        return new Response(PharmacyResource::collection(Pharmacy::all()),200);
    return PharmacyResource::collection(Pharmacy::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pharmacy=Pharmacy::create($request->all());
        return new Response(new PharmacyResource($pharmacy), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        if ($pharmacy){
            return new Response(new PharmacyResource($pharmacy),200);
        }else{
            return new Response("Pharmacy is not Exists",404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());
        return new Response(new PharmacyResource($pharmacy),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return new Response(['msg'=>"Pharmacy Deleted"],204);
    }
}
