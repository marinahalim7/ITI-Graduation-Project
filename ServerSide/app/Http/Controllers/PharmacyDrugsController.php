<?php

namespace App\Http\Controllers;

use App\Models\PharmacyDrugs;
use App\Http\Resources\PharmacyDrugsResource;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Requests\PharmacyDrugsRequest;
use Illuminate\Http\Response;

class PharmacyDrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dump(request()->query('id'));
        $id = request()->query('id');
        $pharmacy = Pharmacy::find($id);
        $drugs = $pharmacy->pharmacy_drugs;
        return  PharmacyDrugsResource::collection($drugs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PharmacyDrugsRequest $request)
    {
        $drug=new PharmacyDrugs();
        $drug->name=request('name');
        $drug->price=request('price');
        $drug->quantity=request('quantity');
        $drug->pharmacy_id=request('pharmacy_id'); 

        if($request->img){
            $this->save_drug_img($request,$drug);
        }
        $drug->save();

        return response()->json(['message' => 'created'], 201);

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
    public function update(PharmacyDrugsRequest $request, string $drugID)
    {
        $drug = PharmacyDrugs::find($drugID);
        $old_img=$drug->img;

        $drug->update($request->all());

        if ($request->img) {
            $this->save_drug_img($request,$drug);  
            if($old_img){
                unlink(public_path('images/pharmacyDrugs/'.$old_img));
            }       
        }
        $drug->save();
        return response()->json(['message' => 'updated'], 200);

    }






    public function getDrug(Request $request)
    {
        $name=$request->query('name');
        $drugs = PharmacyDrugs::all()->where('name',$name);
        if($drugs){
            return PharmacyDrugsResource::collection($drugs);
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
            unlink(public_path('images/pharmacyDrugs/'.$drug->img));
            $drug->delete();
            return Response("Deleted",202);
        }
        else{
            return Response("Drug Doesn't Exist",204);
        }

    }



    private function save_drug_img($request,$object){
        $extension = $request->img->extension();
        $img_name=time(). '_'. uniqid() . '.' .$extension;
        $request->img->move(public_path('images/pharmacyDrugs'),$img_name);
        $object->img=$img_name;
     
    }
}
