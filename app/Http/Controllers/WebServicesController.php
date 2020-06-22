<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userinfo;
use App\Http\Controllers\Phptrait;
use Log;

class WebServicesController extends Controller
{
    use Phptrait;

    public function index() {
        return response()->json(userinfo::get(), 200);

    }

    public function read($id) {
        // echo "$id";
        $status = 1;
        return response()->json(userinfo::find("$id"), 200);
    }


// start of create


    public function create(Request $request) {
        // $request->validate([
        //     // 'name'=>'required',
        //     'email'=>"email",
        //     'pin'=>'required |digits:6| numeric'
        // ]);
        if($request->name == ""){
            $status = 0;
            $message = "Name is required.";
            return response()->json(['status'=>"$status",'message'=>"$message"]);
            
        } 
        else if($request->email == "" || !filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $status = 0;
            $message = "Proper format email is required.";
            return response()->json(['status'=>"$status",'message'=>"$message"]);
            
        } 
        else if($request->pin == ""|| !is_numeric($request->pin) || strlen($request->pin)!=6){
            $status = 0;
            $message = " 6 digit pin is required";
            return response()->json(['status'=>"$status",'message'=>"$message"]);
            
        }

        $email_val = userinfo::where('email','=',"$request->email")->get();
        // echo("$email_val");
        if($email_val->isEmpty()){
            //setEmail function from php trait file
            $this->insertData($request);
            error_log("email sent to "."$request->email");
            Log::info("email sent to $request->email");
            $status = 1;
            $message = "success";

        } else{
            $status = 0;
            $message = "duplicate data (email is already in use)";
            // error_log("email is alreday taken");
            // Log::info("email already taken");
            
        }
        
        // return response()->json(userinfo::get(), 200);
        // return response()->json(userinfo::get(), 200);
        return response()->json(['status'=>"$status",'message'=>"$message"]);
    }

    
// end of create

    public function delete($id){
        $data = userinfo::find($id);
        $data->delete();
        return response()->json(userinfo::get(), 200);
    }
    
}













// public function u_update(Request $request, $id) {
//     return response()->json(userinfo::find($id), 200);
// }
