<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
{
    // get users
    public function getusers()
    {
        $users = User::all();

        if($users->isNotEmpty())    {
                
            return response()->json([
                'status' => 'success',
                'data' => $users,
            ]);
        
        }else{
            return response()->json([
                'status' => 'failure',
                'data' => 'null',
            ]);

        }

    }


    // insert user
    public function insertuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users',
            'phoneNumber' => 'required|string|unique:users',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = new User();
       
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->phoneNumber = $request-> phoneNumber;

        $user->save();

          
            
    return response()->json([
        'status' => 'success',
        'data' => $user
    ]);

    
}


// update user
public function updateuser(Request $request, $user_id)
{
    $user = User::find($user_id);

    if(!$user)
    {
        return response()->json([
            'status' => 'failure',
            'data' => 'Not found this userid ' . $user_id ,
           ]);
    }

    $user->firstName = $request->firstName;
    $user->lastName = $request->lastName;
    $user->email = $request->email;
    $user->phoneNumber = $request->phoneNumber;
   
     $user->save();


    if($user)
    {
        return response()->json([
            'status' => 'success',
            'data' =>  $user ,
           ]);
    }

}


// delete user
  public function deleteuser($user_id)
  {
     
     
     $users = User::find($user_id);
      
     if(!($users))
     {
      return response()->json([
                              'status' => 'failure',
                              'data' => 'Not found this userid ' . $user_id ,
              ]);
     }
     
     $users = User::find($users->id)->delete();

     if($users)    {
                
        return response()->json([
            'status' => 'success',
            'data' => $users,
        ]);
    
    }else{
        return response()->json([
            'status' => 'failure',
            'data' => 'null',
        ]);

    }


  }


}
