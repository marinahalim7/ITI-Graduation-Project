<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Resources\PharmacyResource;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PharmacyAPIsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session::start();
        $data = session::all();
        $slug = session::get('pharmSlug');
        if(!$slug) return('unautherizes');

        return PharmacyResource::collection(Pharmacy::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {
        session::start();
        $data = session::all();
        $slug = session::get('pharmSlug');
        if(!$slug) return('unautherizes');

        $pharmacy = Pharmacy::create($request->all());
        return new PharmacyResource($pharmacy);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        session::start();
        $data = session::all();
        $slug = session::get('pharmSlug');
        if(!$slug) return('unautherizes');

        if ($pharmacy) {
            return new PharmacyResource($pharmacy);
        } else {
            $msg = "This Pharmacy is not exist";
            return new Response($msg, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        session::start();
        $data = session::all();
        $slug = session::get('pharmSlug');
        if(!$slug) return('unautherizes');

        $pharmacy->update($request->all());
        return new PharmacyResource($pharmacy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        session::start();
        $data = session::all();
        $slug = session::get('pharmSlug');
        if(!$slug) return('unautherizes');

        $pharmacy->delete();
        $msg = "Pharmacy Deleted Successfully";
        return new Response($msg, 404);
    }

    
    public function login(Request $request)
    {
        // dd($request);

        $PharmSlug = $request->slug;
        $pharmPassword = $request->password;

        $validatePharm = Validator::make(
            $request->all(),
            [
                'slug' => 'required ',
                'password' => 'required'
            ]
        );

        if ($validatePharm->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validatePharm->errors()
            ], 401);
        }

        $pharmacy = Pharmacy::where('slug', $PharmSlug)->first();
        // dd(!$pharmacy || password_verify($pharmPassword, $pharmacy->password));
        if (!$pharmacy || password_verify($pharmPassword, $pharmacy->password)) {
            return response()->json(
                [
                    'massage' => 'Invalid credentials'
                ],
                401
            );

        }
        session_start();
        session::put('pharmSlug', $PharmSlug);
        session::put('pharmPassword', $pharmPassword);

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