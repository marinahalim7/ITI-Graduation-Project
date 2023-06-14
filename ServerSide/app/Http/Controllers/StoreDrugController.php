<?php

namespace App\Http\Controllers;
use App\Models\StoreDrug;
use Illuminate\Http\Request;
use App\Models\Store;

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
    public function store(Request $request)
    {
        //
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
       // Find the store
       $store = Store::find($storeId);

       // Check if the store exists
       if (!$store) {
           return response()->json(['message' => 'Store does not exist'], 404);
       }
        // Find the store drug within the store
        $storeDrug = $store->store_drugs()->find($drugId);

        // Check if the store drug exists within the store
        if (!$storeDrug) {
            return response()->json(['message' => 'Store drug not found'], 404);
        }

       $storeDrug->update($request->all());
       return response()->json(['message' => 'Store drug updated successfully'], 200);
   }



  public function destroy($storeId, $drugId)
     {
        // Find the store
        $store = Store::find($storeId);

        // Check if the store exists
        if (!$store) {
            return response()->json(['message' => 'Store does not exist'], 404);
        }

        // Find the store drug within the store
        $storeDrug = $store->store_drugs()->find($drugId);

        // Check if the store drug exists within the store
        if (!$storeDrug) {
            return response()->json(['message' => 'Store drug not found'], 404);
        }

        // Delete the store drug
        $storeDrug->delete();

        // Return success message
        return response()->json(['message' => 'Store drug deleted successfully'], 200);
    }


}