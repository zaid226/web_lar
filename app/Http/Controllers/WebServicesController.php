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
        return response()->json(userinfo::find("$id"), 200);
    }

    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>"required | email",
            'pin'=>'required |digits:6| numeric'
        ]);

        $email_val = userinfo::where('email','=',"$request->email")->get();
        // echo("$email_val");
        if($email_val->isEmpty()){
            $this->setEmail($request);
            error_log("email sent to "."$request->email");
            Log::info("email sent to $request->email");
        } else{
            echo ("email is alreday taken");
            // error_log("email is alreday taken");
            // Log::info("email already taken");
        }
        
        return response()->json(userinfo::get(), 200);
    }

    
    public function delete($id){
        $data = userinfo::find($id);
        $data->delete();
        return response()->json(userinfo::get(), 200);
    }
    
}
