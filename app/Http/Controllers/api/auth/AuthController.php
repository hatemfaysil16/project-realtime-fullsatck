<?php

namespace App\Http\Controllers\api\auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Http\Controllers\api\apiResponseTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use apiResponseTrait;


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $errors = $validator->errors();
        if($errors->any())
        {
            foreach ($errors->all() as $error) {
              return  $this->apiResponse(null,$error,false);
           }
        }

        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);

    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            // 'token'=>'required'
        ],[
            'name.required' => 'برجاء ادخال الاسم',
            'email.required' => 'برجاء ادخال البريد الالكتروني',
            'password.required' => 'برجاء ادخال الرقم السري',
            // 'token.required' => 'برجاء token',
        ]);




        $errors = $validator->errors();
        if($errors->any())
        {
            foreach ($errors->all() as $error) {
              return  $this->apiResponse(null,$error,false);
           }
        }



        $user = User::firstOrCreate(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)],

        ));




        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user->update(['token' => $token ]);


        return response()->json([
            'message' => 'User successfully registered',
            'data'=>[
            'user' => $user,
            // 'access_token'=>$token,

            ],
            'status'=>true
        ]);
    }







    public function updateUsers(Request $request)
{
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
            'password' => 'string|min:6|confirmed',
        ],[
            'name.required' =>'برجاء ادخال الاسم ',
            'email.required'=>'برجاء ادخال البريد الالكتروني',
            'password.required'=>'برجاء ادخال الرقم السري',

        ]);

        $errors = $validator->errors();
        if($errors->any())
        {
            foreach ($errors->all() as $error){
              return  $this->apiResponse(null,$error,false);
            }
        }


        $doc = User::find(Auth()->user()->id);



        if($request->input('password')== Null)
        {
            $a = $request->input('password');
        }else{
                $doc->update([
            'password' =>Hash::make($request->password),
                ]);
        }

        if($request->input('email')== Null)
        {
            $a = $request->input('email');
        }else{
                $doc->update([
            'email' => $request->email,
                ]);
        }

        if($request->input('name')== Null)
        {
            $a = $request->input('name');
        }else{
                $doc->update([
            'name' => $request->name,
                ]);
        }


            $updateData= ['user'=>$doc];
            return $this->apiResponse($updateData,'is success update users',true);



    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        if(auth('api')->user())
        {
            $data = ['user'=>auth("api")->user()];
            return $this->apiResponse($data,'is success show users',true);
        }else{
            return $this->apiResponse(null,'is failed show users',false);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            "message"=> "User successfully login",
            // 'expires_in' => auth('api')->factory()->getTTL() * 60,
            'data'=>[
                'user' => auth('api')->user(),
                // 'access_token' => $token,
                // 'token_type' => 'bearer',
            ],
            'status'=>true
        ]);
    }

}
