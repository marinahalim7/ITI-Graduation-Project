<?php

namespace App\Http\Controllers;

use App\Models\UserDrug;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserDrugRequest;
use App\Http\Resources\userDrugResource;
use App\Http\Resources\DrugResource;
use App\Http\Resources\DrugDetailsResource;
class UserDrugController extends Controller
{
    
    public function index()  // display drugs for specific user
    {
        $user = User::find(2);  // user who loginIn
        $drugs = $user->user_drugs->where('publishable', true);
 
        if($drugs->isEmpty()){
           return response()->json(['message' => 'No drugs found'], 404);
         }
           return  DrugResource::collection($drugs);
        
    }

    public function getAllUSersDrugs(){

        $drugs = UserDrug::where('publishable', true)->get();
        if($drugs->isEmpty()){
            return response()->json(['message' => 'No drugs found'], 404);
          }
          return  userDrugResource::collection($drugs); 
    }
    
    public function getDrugsByName(Request $request,$name)
    {
          $drugs = UserDrug::where('name',$name)->where('publishable', true)->get();
          if($drugs->isEmpty()){
            return response()->json(['message' => 'No drugs found'], 404);
          }
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

        return response()->json(['message' => 'created'], 201);

    }

    public function show(string $drugID)
    {
          $drug = UserDrug::where('id',$drugID)->where('publishable', true)->first();
          if($drug){
            return new DrugDetailsResource($drug);
            } 
            return response()->json(['message' => 'Not found'], 200);

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
        return response()->json(['message' => 'updated'], 200);

      


    }

    public function destroy(string $drugID)
    {
        $drug = UserDrug::find($drugID);
        if($drug){
            unlink(public_path('images/userDrugs/'.$drug->img));
            unlink(public_path('images/userDrugs/'.$drug->exp_img));
            $drug->delete();
            return response()->noContent();
        }
        return response()->json(['message' => 'Not Found'], 400);

        
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

    // Admin Routes
    public function display_Unpublished_Drugs(){
        $drugs = UserDrug::where('publishable', false)->get();
        if($drugs->isEmpty()){
            return response()->json(['message' => 'No drugs found'], 404);
          }
          return  DrugDetailsResource::collection($drugs);
        
    }

    public function delete_Drug(string $drugID){
        $drug = UserDrug::find($drugID);
        if($drug){
            unlink(public_path('images/userDrugs/'.$drug->img));
            unlink(public_path('images/userDrugs/'.$drug->exp_img));
            $drug->delete();
            return response()->noContent();
        }
        return response()->json(['message' => 'Not Found'], 400);


    }

    public function update_Drug(string $drugID){
        $drug = UserDrug::find($drugID);
        if ($drug) {
         $drug->publishable = true;
         $drug->save();
         return response()->json(['message' => 'updated'], 200);

        }

    }
   
  
   

}
