<?php

namespace App\Http\Controllers;

use App\Models\UserDrug;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserDrugRequest;
use App\Http\Resources\userDrugResource;

class UserDrugController extends Controller
{
    
    public function index()
    {
        $user = User::find(3);
        $drugs = $user->user_drugs->where('publishable', true);
        return  userDrugResource::collection($drugs);
    }

    
    public function store(StoreUserDrugRequest $request)
    {
        $drug=new UserDrug();
        $drug->name=request('name');
        $drug->exp_date=request('exp_date');
        $drug->price=request('price');
        $drug->quantity=request('quantity');
        $drug->publishable=request('publishable'); // Note >>>>>>>> for test only
        $drug->user_id=request('user_id'); 

        if ($request->img) {                         // to handle drug_ img
           $this->save_drug_img($request,$drug);
        }
        
        if ($request->exp_img) {                         // to handle exp_img
            $this->save_drug_exp_img($request,$drug);
        }
        $drug->save();

  
      // $user = User::find($request->input('user_id')); // retrive login user
    //    $user->user_drugs()->attach($drug->id);       // store in pivot table
    


       return  Response('created',201);
    }

    
    public function show(string $id)
    {
        $drugs = UserDrug::find($id);

          return new userDrugResource($drugs);
    }

  
    public function update(StoreUserDrugRequest $request, UserDrug $userDrug)
    {
        //
    }

   
    public function destroy(UserDrug $userDrug)
    {
       // dd($userDrug);
        $userDrug->delete();
    }

    private function save_drug_img($request,$object){
        $extension = $request->img->extension();
        $img_name=time(). '_'. uniqid() . '.' .$extension;
        $request->img->move(public_path('images/userDrugs'),$img_name);
        $object->img=$img_name;
     
    }

    private function save_drug_exp_img($request,$object){
        $extension = $request->exp_img->extension();
        $img_name=time(). '_'. uniqid() . '.' .$extension;
        $request->exp_img->move(public_path('images/userDrugs'),$img_name);
        $object->exp_img=$img_name;
     
    }

}
