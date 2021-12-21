<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\User;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Función que utilizaremos para registrar al usuario
    public function register(Request $request)
    {
        //Indicate what we want to receive in the request
        $data = $request->only('first_name', 'last_name', 'email', 'password','rol');
        //Validate the data
        $validator = Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'rol'=> 'required|string',
        ]);
        //return error in case of failling
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //Create User 
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->assignRole($request->rol); //Assign a role to the user

        if($request->rol=='manager'){
            $user->manager()->create();
        }



        //kepp the credentials to generate the token
        $credentials = $request->only('email', 'password');
        //Return the response with the user token
        return response()->json([
            'message' => 'User created',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ], Response::HTTP_OK);
    }
    //Function used to login
    public function authenticate(Request $request)
    {
        //Indicate what to receive
        $credentials = $request->only('email', 'password');
        //Validations
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);
        //Return an error in case  the validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        //attepmt to login
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                //Incorrect credentials
                return response()->json([
                    'message' => 'Login failed',
                ], 401);
            }
        } catch (JWTException $e) {
            //ctach an error
            return response()->json([
                'message' => 'Error',
            ], 500);
        }
        //return token
        return response()->json([
            'token' => $token,
            'user' => Auth::user()->with('roles')->where('email','=',$request->email)->get()
        ]);
    }
    //Logout function
    public function logout(Request $request)
    {
        //Validate the token is sent
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);
        //If validation fails 
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        try {
            //If token is valid disconect the user
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User disconnected'
            ]);
        } catch (JWTException $exception) {
            //catch erro
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //Function to get the logged user
    public function getUser(Request $request)
    {
   
        $this->validate($request, [
            'token' => 'required'
        ]);
        
        $user = JWTAuth::authenticate($request->token);
   
        if (!$user) {
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);
        }

        return response()->json(['user' => $user]);
    }
}
