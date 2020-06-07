<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userinfo;
use App\Http\Controllers\Phptrait;
use Log;

class ATGController extends Controller
{
    use Phptrait;

    function insert(Request $req){
        
        $req->validate([
            'name'=>"required",
            'email'=>"required | email | unique:userinfos,email",
            'pin'=>"required | digits:6 | numeric"
        ]);

        // print_r($req->input());
        ?>
        <script>
            alert("form has been submitted")
        </script>

        <h2><a href="https://stark-journey-89055.herokuapp.com/home">Go to home</a></h2>
        
        <?php
        log::info("email has been sent to ".$req->email);
        error_log("email has been sent on ".$req->email);
        echo ("email has been sent on ");

        ?><a href="<?php echo "$req->email";?>"><?php echo "$req->email";?></a>
        <?php
        $this->setEmail($req);

        // echo ("<h3>Redirecting to home in 4 seconds</h3>");
        
        // return redirect()->back();
        
    }   
}
