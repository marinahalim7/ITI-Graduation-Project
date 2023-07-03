<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{

        //  function __construct()
    // {
    //     $this->middleware('auth:sanctum')->only('store');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        $this->save_image($request->img, $user);
        return new UserResource($user);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    private function save_image($img, $article){
        if ($img){
            $img_name = time().'.'.$img->extension();
            $img->move(public_path('images/users'),$img_name);
            $article->img = $img_name;
            $article->save();
        }
    }

    public function userLogin(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required |email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            // } else {
            $user = User::where('email', $request->email)->first();


            ##test for the token at frontEnd.............
            // Revoke all tokens for the user
            // Sanctum::revokeTokens($user);
            $user->tokens()->delete();

            if ($user) {
                return $user;
            }
            // }


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'massage' => $th->getMessage()
            ], 500);
        }
    }

}
