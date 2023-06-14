<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
   
    public function index()
    {
        return StoreResource::collection(Store::all());
    }

 
    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->all());
        return new StoreResource($store);
    }

  
    public function show(Store $store)
    {
        if ($store){
            return new StoreResource($store);
        }else{
            return response()->json(['message' => 'This Store is not exist'], 404);
        }
    }

 
    public function update(Request $request, Store $store)
    {
        $store->update($request->all());
        return new StoreResource($store);
    }


    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['message' => 'Store deleted successfully'], 200);
    }
}
