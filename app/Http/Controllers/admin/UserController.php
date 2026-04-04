<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function users(){

   $users= User::orderBy('created_at','DESC')->paginate(10);
   return view('admin/user_list', ['users'=> $users]);
    }

    public function show_edit_user($id){
        
        $user=User::findOrFail($id);
        // dd($user);
        return view('admin/edit_user', ['user'=> $user]);
    }

    public function editUser(Request $r){

    // return $r;
     $id=$r->user_id;
    $validator = Validator::make($r->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users,email,'.$id.',id',
    ]);

    if ($validator->passes()) {
      // update the user 
      $user=User::find($id);
      $user->name=$r->name;
      $user->email=$r->email;
      $user->designation=$r->designation;
      $user->mobile=$r->mobile;
      $user->save();

      return response()->json([
        'status' => true,
        'errors' => []
      ]);
    }else{
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
    }

    public function deleteUser(Request $r){

      $user = User::find($r->id);
    if ($user == null) {
      return -2;
    }

    $user->delete();
    return 1;
    }
}
