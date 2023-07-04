<?php

namespace App\Http\Controllers;

use App\Models\StoreDrug;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Http\Response;
use App\Http\Requests\StoreStoreDrugRequest;
use App\Http\Resources\StoreDrugResource;
use App\Http\Requests\UpdateStoreDrugRequest;

class StoreDrugController extends Controller
{
    /**
     * Display a listing of store resource.
     */

    public function index($storeId) #get all drugs of specific store
    {

        $storeDrugs = StoreDrug::where('store_id', $storeId)->get();
        return response()->json($storeDrugs);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreDrugRequest $request, $id)
    {
        $storeId = $id;

        $storeDrug = new StoreDrug;

        $storeDrug->name = $request->name;
        $storeDrug->price = $request->price;
        $storeDrug->quantity = $request->quantity;
        $storeDrug->store_id = $storeId;
        $this->save_img($request, $storeDrug);
        $storeDrug->save();
        return new Response('created', 200);

    }

    /**
     * Display store specified resource.
     */
    public function show($storeID, $drugId) #get drug info
    {
        $storeDrug = StoreDrug::where('store_id', $storeID)
            ->where('id', $drugId)
            ->firstOrFail();

        if ($storeDrug) {

            return response()->json($storeDrug);
        } else {
            return response()->json(['message' => 'This drug is not exist in store'], 404);
        }
    }

    public function showAllDrug() ##get all drugs of all stores
    {
        $storeDrug = StoreDrug::all();
        return $storeDrug;

    }
    public function getstores($drugName) ##get all stores of specific drug
    {
        $storeNames = Store::whereHas('store_drugs', function ($query) use ($drugName) {
            $query->where('name', 'like', $drugName);
        })->get();

        if ($storeNames->isEmpty()) {
            return response()->json(['message' => 'This drug is not exist in store'], 404);
        } else {
            return response()->json($storeNames);
        }
    }

    public function search($drugName)
{
    // Retrieve all instances of the drug name across all stores
    $storeDrugs = StoreDrug::where('name', 'like', "%{$drugName}%")->get();

    return response()->json($storeDrugs);
}

    public function update(UpdateStoreDrugRequest $request, $storeId, $drugId)
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
        $storeDrug->update($request->all());
        if ($request->img) {
            $this->save_img($request, $storeDrug);
            if ($old_img) {
                unlink(public_path('images/storeDrug/' . $old_img));
            }
        }
        $storeDrug->save();
        return response()->json(['message' => 'Store drug updated successfully'], 200);
    }

    public function destroy($storeId, $drugId)
    {
        $store = Store::find($storeId);
        if (!$store) {
            return response()->json(
                ['message' => 'Store does not exist'],
                404
            );
        }
        $storeDrug = $store->store_drugs()->find($drugId);
        if (!$storeDrug) {
            return response()->json(
                ['message' => 'Store drug not found'],
                404
            );
        }
        // delete the image from storeDruges folder
        unlink(public_path('images/storeDrug/' . $storeDrug->img));
        $storeDrug->delete();
        return response()->json(
            ['message' => 'Store drug deleted successfully'],
            200
        );
    }
    private function save_img($request, $storeDrug)
    {
        $image = $request['img'];
        $imgName = time() . '.' . $image->extension();
        $request->img->move(public_path('images/storeDrug'), $imgName);
        $storeDrug->img = $imgName;

    }
}