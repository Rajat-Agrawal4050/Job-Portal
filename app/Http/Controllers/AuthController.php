<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  //
  public function register()
  {
    return view('register');
  }

  public function login()
  {
    return view('login');
  }
  public function dashboard()
  {
    return view('admin.dashboard');
  }

  public function user_profile()
  {
    $id = Auth::user()->id;
    $user = User::where('id', $id)->first();

    return view('profile', compact('user'));
  }

  public function updateProfile(Request $r)
  {
    // dd($r);
    $id = $r->user_id;
    $validator = Validator::make($r->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $id . ',id',
    ]);

    if ($validator->passes()) {
      // update the user 
      $user = User::find($id);
      $user->name = $r->name;
      $user->email = $r->email;
      $user->designation = $r->designation;
      $user->mobile = $r->mobile;
      $user->save();

      session()->flash('success', 'Profile updated sucessfully.');

      return response()->json([
        'status' => true,
        'errors' => []
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }

  public function processRegister(Request $r)
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

      Auth::login($user);

      return response()->json([
        'status' => true,
        'errors' => []
      ]);
    } else {

      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }

  public function processLogin(Request $r)
  {

    $validator = Validator::make($r->all(), [
      'email' => 'required|email',
      'password' => 'required|min:5',
    ]);

    if ($validator->passes()) {

      $remember = false;
      if ($r->remember_me) {
        $remember = true;
      }

      if (Auth::attempt(['email' => $r->email, 'password' => $r->password], $remember)) {

      $r->session()->regenerate(); 

        return response()->json([
          'status' => true,
          'login' => true,
          'errors' => []
        ]);
      } else {
        return response()->json([
          'status' => true,
          'login' => false,
          'errors' => []
        ]);
      }
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }

  function logout(Request $r)
  {

    Auth::logout();
     $r->session()->invalidate();
     $r->session()->regenerateToken(); // Regenerate CSRF token
     
    return redirect()->route('home');
  }

  

  function uploadImage(Request $r)
  {

    $validator = Validator::make($r->all(), [
      'image_file' => 'required|image|max:2048' // max size in kilobytes (KB)
    ]);

    if ($validator->passes()) {

      $id = Auth::user()->id;

      $file = $r->file('image_file');
      $ext = $file->getClientOriginalExtension();
      $image_name = $id . '-' . time() . '.' . $ext;

      $file->move(public_path('/profile_pic/'), $image_name);

      User::where('id', $id)->update(['profile_pic' => $image_name]);

      session()->flash('success', 'Profile Picture Uploaded Sucessfully.');

      return response()->json([
        'status' => true,
        'errors' => []
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }

  public function updatePassword(Request $r)
  {

    $validator = Validator::make($r->all(), [
      'old_password' => 'required',
      'new_password' => 'required|min:5',
      'cpassword' => 'required|same:new_password',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }

    if (Hash::check($r->old_password, Auth::user()->password) == false) {

      session()->flash('error', 'Old Password is incorrect.');
      return response()->json([
        'status' => true,
      ]);
    }

    $user = User::find(Auth::user()->id);
    $user->password = Hash::make($r->new_password);
    $user->save();

    session()->flash('success', 'Password updated Successfully.');
    return response()->json([
      'status' => true,
    ]);
  }
}
