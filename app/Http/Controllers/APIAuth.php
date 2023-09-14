<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIAuth extends Controller
{
  public function __invoke(Request $request)
  {
    //set validation
    $validator = Validator::make($request->all(), [
      'nik'  => 'required',
      'password'  => 'required'
    ]);

    //if validation fails
    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    //get credentials from request
    $credentials = $request->only('nik', 'password');

    //if auth failed
    if (!$token = auth()->guard('api')->check($credentials)) {
      return response()->json([
        'success' => false,
        'message' => 'NIK atau Password Anda salah'
      ], 401);
    }

    //if auth success
    return response()->json([
      'success' => true,
      'user'    => auth()->guard('api')->user(),
      'token'   => $token
    ], 200);
  }

  public function login(Request $request)
  {
    $data = [
      'nik' => $request->nik,
      'password' => $request->password
    ];

    if (auth()->check($data)) {
      $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
      return response()->json(['token' => $token], 200);
    } else {
      return response()->json(['error' => 'Unauthorised'], 401);
    }
  }
}
