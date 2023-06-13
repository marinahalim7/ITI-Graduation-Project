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
        return new PharmacyResource($pharmacy);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        if ($pharmacy){
            return new PharmacyResource($pharmacy);
        }else{
            $msg="This Pharmacy is not exist";
            return new Response($msg,404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());
        return new PharmacyResource($pharmacy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        $msg="Pharmacy Deleted Successfully";
        return new Response($msg,404);
    }
}
