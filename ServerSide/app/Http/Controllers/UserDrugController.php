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
        $user = User::find(1);  // user who loginIn
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

       return  Response('created',201);
    }

    
    public function show(string $drugID)
    {
          $drug = UserDrug::find($drugID);
          return new userDrugResource($drug);
    }

  
    public function update(Request $request, string $drugID)
    {
       

        $drug = UserDrug::find($drugID);
        $old_img=$drug->img;
        $old_exp_img=$drug->exp_img;
     
        $drug->update($request->all());

        if ($request->img) {
            $this->save_drug_img($request,$drug);  
            if($old_img){
                unlink(public_path('images/userDrugs/'.$old_img));
                
            }       
        }

        if ($request->exp_img) {
            $this->save_drug_exp_img($request,$drug);  
            if($old_exp_img){
                unlink(public_path('images/userDrugs/'.$old_exp_img));
            }  
              
        }
        $drug->save();
      


    }

    public function destroy(string $drugID)
    {
        $drug = UserDrug::find($drugID);
        unlink(public_path('images/userDrugs/'.$drug->img));
        unlink(public_path('images/userDrugs/'.$drug->exp_img));

        $drug->delete();
        
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
