<?php

namespace App\Http\Controllers;
use App\userinfo;


trait Phptrait{
    public function print(){
        echo "Inside insert func in atgcontroller";
    }

    public function setEmail($req){
            $new_user = new userinfo;
            $new_user->name = $req->name;
            $new_user->email = $req->email;
            $new_user->pincode = $req->pin;
            $new_user->save();
    }

}