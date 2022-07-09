<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'hoten' => 'required|string',
            'dienthoai' => 'required|string',
            'msdn' => 'required|string|unique:users',
            'msdv' => 'required|string',
            'password' => 'required',
        ]);
        try {
            $hoten = $request->input('hoten');
            $msdn = $request->input('msdn');
            $msdv = $request->input('msdv');
            $dienthoai = $request->input('dienthoai');
            $plainPassword = $request->input('password');
            $password = app('hash')->make($plainPassword);
            app('db')->connection('mysql')->select("INSERT INTO users(msdv,msdn,`password`,hoten,dienthoai) VALUES ('$msdv','$msdn','$password','$hoten','$dienthoai')");

            //return successful response
            return response()->json(['msdn' => $msdn, 'hoten' => $hoten, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'msdn' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['msdn', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
