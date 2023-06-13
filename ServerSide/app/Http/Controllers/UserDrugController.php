<?php

namespace App\Http\Controllers;

use App\Models\UserDrug;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserDrugRequest;

class UserDrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "ddd";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDrugRequest $request)
    {

       $drug= UserDrug::create($request->all());

       $user = User::find($request->input('user_id'));
    //    dd($drug);
    //    dd($user);

           
         $user->user_drugs()->attach($drug->id);


        // if ($request->image) {
        //     $this->save_image($request,$article);
               
        // }
        return  Response('created',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDrug $userDrug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserDrugRequest $request, UserDrug $userDrug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDrug $userDrug)
    {
        //
    }
}
