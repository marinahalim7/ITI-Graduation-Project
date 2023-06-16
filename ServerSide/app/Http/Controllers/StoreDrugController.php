<?php

namespace App\Http\Controllers;
use App\Models\StoreDrug;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Http\Response;
use App\Http\Requests\StoreStoreDrugRequest;

class StoreDrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $storeDrug = StoreDrug::all();
        return $storeDrug;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreDrugRequest $request)
    {
    
      $storeDrug = StoreDrug::create($request->all());   
      $this->save_img($request, $storeDrug);
      $storeDrug->save();
      return new Response('created', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(StoreDrug $storeDrug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $storeId, $drugId)
    {
       
       $store = Store::find($storeId);

       if (!$store) {
           return response()->json(['message' => 'Store does not exist'], 404);
       }

        $storeDrug = $store->store_drugs()->find($drugId);
       
        if (!$storeDrug) {
            return response()->json(['message' => 'Store drug not found'], 404);
        }
        $old_img = $storeDrug->img;
        // dd($old_img);
        $storeDrug->update($request->all());
     
        if ($request->img) {
            $this->save_drug_img($request,$storeDrug);  
            if($old_img){
                dd('ee');
                unlink(public_path('images/storeDrugs/'.$old_img));
            }
        }
        $storeDrug->save();
   
       return response()->json(['message' => 'Store drug updated successfully'], 200);
   }
  public function destroy($storeId, $drugId)
     {
        $store = Store::find($storeId);

        if (!$store) {
            return response()->json(['message' => 'Store does not exist'], 404);
        }

        $storeDrug = $store->store_drugs()->find($drugId);

        if (!$storeDrug) {
            return response()->json(['message' => 'Store drug not found'], 404);
        }
        // delete the image from storeDruges folder
        unlink(public_path('images/storeDrugs/' .$storeDrug->img));
        $storeDrug->delete();


        return response()->json(['message' => 'Store drug deleted successfully'], 200);
    }


    private function save_img($request,$storeDrug)
    {
        $image = $request['img'];
        $imgName = time().'.'.$image->extension();
        $request->img->move(public_path('images/storeDrug'),$imgName);
        $storeDrug->img = $imgName;

    }
}