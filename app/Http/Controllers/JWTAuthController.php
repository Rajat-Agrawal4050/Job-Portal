<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JWTAuthController extends Controller
{
    //
// jwt auth ko ham api routes ko access karne ke liye banate hai taki api authentication kiya ja sake, user credential dekar login karta hai
// to use ek jwt token return kiya jata hai jo ki browser(local storage) ya cookie me saved rahta hai phir user login ke baad jab bhi protected
// route ko access karne jata hai to use request ke sath me ye jwt token bhi dena hota hai taki uski request validate ho sake 
// yahi token invaild ya expire ho jata hai to use login par redirect kar diya jata hai
// user apna access token ko refersh token se exchange karne ke liye bhi request kar sakta hai
// jwt auth ka use api endpoints ko secure karne ke liye kiya jata hai 
     public function register(Request $r)
  {

    // return $r;
    $validator = Validator::make($r->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password3' => 'required|min:5|same:password4',
      'password4' => 'required',
    ]);

    if ($validator->passes()) {

      $user = new User();
      $user->name = $r->name;
      $user->email = $r->email;
      $user->password = Hash::make($r->password3);
      $user->save();

      $resp_token=Auth::guard('api')->login($user);

      return response()->json([
        'status' => true,
        'data'=> $resp_token,
        'errors' => []
      ]);
    } else {

      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }

 public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
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

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
