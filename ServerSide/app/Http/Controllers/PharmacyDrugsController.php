<?php

namespace App\Http\Controllers;

use App\Models\PharmacyDrugs;
use App\Http\Resources\PharmacyDrugsResource;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PharmacyDrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacy = Pharmacy::find(4);
        $drugs = $pharmacy->pharmacy_drugs;
        return  PharmacyDrugsResource::collection($drugs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $drug=new PharmacyDrugs();
        $drug->name=request('name');
        $drug->price=request('price');
        $drug->quantity=request('quantity');
        $drug->pharmacy_id=request('pharmacy_id'); 
        
        $drug->save();

       return  Response($drug,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drugs = PharmacyDrugs::find($id);
        if($drugs){
            return Response(new PharmacyDrugsResource($drugs),200);
        }
        else{
            return Response("Drug Doesn't Exist",202);
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PharmacyDrugs $drug)
    {
        $drug->update($request->all());
    }


    public function getDrug(string $name)
    {
        $drugs = PharmacyDrugs::find()->where('name',$name);
        if($drugs){
            return Response(new PharmacyDrugsResource($drugs),200);
        }
        else{
            return Response("Drug Doesn't Exist",202);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $drug = PharmacyDrugs::find($id);
        if($drug){
            $drug->delete();
            return Response("Deleted",202);
        }
        else{
            return Response("Drug Doesn't Exist",204);
        }

    }
}
