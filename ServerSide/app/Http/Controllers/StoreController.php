<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    public function index()
    {
        session::start();
        $data = session::all();
        $slug = session::get('storeSlug');
        if(!$slug) return('unautherizes');

        return StoreResource::collection(Store::all());
    }


    public function store(StoreStoreRequest $request)
    {
        session::start();
        $data = session::all();
        $slug = session::get('storeSlug');
        if(!$slug) return('unautherizes');

        $store = Store::create($request->all());
        return new StoreResource($store);
    }


    public function show(Store $store)
    {
        session::start();
        $data = session::all();
        $slug = session::get('storeSlug');
        if(!$slug) return('unautherizes');

        if ($store) {
            return new StoreResource($store);
        } else {
            return response()->json(['message' => 'This Store is not exist'], 404);
        }
    }


    public function update(Request $request, Store $store)
    {
        session::start();
        $data = session::all();
        $slug = session::get('storeSlug');
        if(!$slug) return('unautherizes');

        $store->update($request->all());
        return new StoreResource($store);
    }


    public function destroy(Store $store)
    {
        session::start();
        $data = session::all();
        $slug = session::get('storeSlug');
        if(!$slug) return('unautherizes');

        $store->delete();
        return response()->json(['message' => 'Store deleted successfully'], 200);
    }

    
    public function login(Request $request)
    {

        $storeSlug = $request->slug;
        $storePassword = $request->password;

        $validateStore = Validator::make(
            $request->all(),
            [
                'slug' => 'required ',
                'password' => 'required'
            ]
        );

        if ($validateStore->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateStore->errors()
            ], 401);
        }

        $store = Store::where('slug', $storeSlug)->first();
        if (!$store || password_verify($storePassword, $store->password)) {
            // dd('ss');
            return response()->json(
                [
                    'massage' => 'Invalid credentials'
                ],
                401
            );

        }
        session_start();
        session::put('storeSlug', $storeSlug);
        session::put('storePassword', $storePassword);

        return response()->json(
            [
                'massage' => 'loggedIn',
            ],
            200
        );
    }

    public function logout()
    {
        session::flush();
        return response()->json(
            [
                'massage' => 'done'
            ],
            401
        );

    }

}