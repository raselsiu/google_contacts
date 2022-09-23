<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;

class Apis extends Controller
{


    public function welcome()
    {
        $user = User::all();

        return response()->json([
            'status' => 200,
            'message' => $user
        ]);
    }

    public function register(Request $request)
    {

        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $responseArray = [];
        $responseArray['token'] = $user->createToken('MyApp')->accessToken;
        $responseArray['name'] = $user->name;

        return response()->json($responseArray, 200);
    }



    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $responseArray = [];
            $responseArray['token'] = $user->createToken('MyApp')->accessToken;
            $responseArray['name'] = $user->name;

            return response()->json($responseArray, 200);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 203);
        }
    }
}
