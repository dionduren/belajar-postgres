<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            $user = Auth::user();
            $success['id'] =  $user->id;
            $success['nik'] =  $user->nik;
            $success['nama'] =  $user->nama;
            $success['email'] =  $user->email;
            $success['unit_kerja'] =  $user->unit_kerja;
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    // function Login(Request $request)
    // {
    //     $user = User::where('nik', $request->nik)->first();

    //     if ($user != '[]' && Hash::check($request->password, $user->password)) {

    //         $token = $user->createToken('Personal Access Token')->plainTextToken;

    //         $response = [
    //             'status' => 200,
    //             'token' => $token,
    //             'user' => $user,
    //             'message' => 'Successfully Login! Welcome Back'
    //         ];
    //         return response()->json($response);
    //     } else if ($user == '[]') {

    //         $response = [
    //             'status' => 500,
    //             'message' => 'No account found with this nik'
    //         ];
    //         return response()->json($response);
    //     } else {

    //         $response = [
    //             'status' => 500,
    //             'message' => 'Wrong nik or password! please try again'
    //         ];
    //         return response()->json($response);
    //     }
    // }
}
