<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    /** 
     *Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
      // request validation
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

      if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        //register all request with password encryption
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input);

        //genrate token  
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['name'] =  $user->name;

        //return response
        return response()->json(['success'=>$success],$this->successStatus);
      
      }

     public function login(){ 

       //check user credentials for login
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            
            // genrate token
            $user = Auth::user(); 
            $success['token'] = $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }



    public function show()
    {
        //fetch all user detail
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
       
    }



    public function edit($id)
    { 
      //fetch detail only for given id
       $data = User::find($id);

       if($data)
       {
          return response()->json(['data' => $data]);
       }
       else
       {
         return response()->json(['msg'=>"User id not found"]);
       }

     }


    public function update(Request $request,$id)
    {  
      //update request for given id
        $user =User::find($id);
        if($user)
        {
            $user->update($request->all());

            return response()->json($user);
        }
        else
        {
            return response()->json(['msg'=>"User id not found"]);
        } 
        
    }

    public function delete(Request $request,$id)
   { 
    //delete request for given id
      $user =User::find($id);

      if($user)
      {
          $user->delete();
          return response()->json(['msg'=>"delete succesfully"],$this->successStatus);
      }
      else
      {
          return response()->json(['msg'=>"User id not found"]);
      }
     
   }


   public function logout()
   {  
     //delete token for authenticated user
      Auth()->user()->token()->revoke();
     
     //destroy all the session & logout
      Session::flush();

      return response()->json(['msg'=>"logged out"],$this->successStatus);
   }
  


}
