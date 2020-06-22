<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <style>
            *{
                margin: 0px;
                padding: 0px;
            }
            body{
                //need to change
                background-color: #F0F8FF;
                text-align: center;
            }
            .cont{
                height: 100vh;
            }
            .header{
                padding-top: 30px;
                height: 20%;
                /* padding-bottom: 10px; */
            }
            .form{
                height: 70%;
                text-align:center;
                /* dispaly:flex; */
            }
            form input{
                margin-bottom: 8px;
            }
            .footer{
                height: 10%;
                /* padding-top: 10px; */
            }
            .error{
                /* background-color: rgb(245, 23, 23); */
                color: red;
                padding-bottom: 10px;
            }
            .errors{
                color: red;
                padding-bottom: 10px;
            }
        </style>
    
    </head>
    <body>
        <div class="cont">
            <div class="header">
                <h2>Basic Web Application</h2>
            </div>
            <div class="error">
            @foreach($errors->all() as $err)
                <ul>
                    <li>{{$err}}</li>
                </ul>
                @endforeach
            </div>
            <div id="errors">
            </div>
            <div class="form">            
                <form method="POST">
                    @csrf
                    <input type="text" name="name" id="name" placeholder="Name">
                    <br>
                    <input type="text" name="email" id="email" placeholder="Email">
                    <br>
                    <input type="text" name="pin" id="pin" placeholder="Pincode">
                    <br>
                    <button id = "submitbtn" type="button">Submit</button>
                </form>
               
            </div>
            <div class="footer">
                <p>Developed By M Zaid Khan.</p>
            </div>
        </div>
    </body>
</html>

<script>


let submitbtn = document.getElementById('submitbtn');
submitbtn.addEventListener('click',insertHandler);

function insertHandler() {
    
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var pin = document.getElementById('pin').value;
    console.log("button clicked");

    const xhr = new XMLHttpRequest();

    xhr.open('POST','https://stark-journey-89055.herokuapp.com/api/create', true);

    xhr.getResponseHeader('Content-Type','application/json');

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if(this.status == 200){
            var res = JSON.parse(this.responseText);
            console.log(res);
            var errors = document.getElementById('errors');
            var status = res.status;
            var message = res.message;
            // console.log(status +"<br/>"+ error);
            console.log("button clicked");
            errors.innerHTML = "status: "+status +'<br>'+"message: "+message;
        } else {
            console.log('Ops!! error occured');
        }   
    }
    var obj = {
        name: name,
        email: email,
        pin: pin
    };
    // var param = 
    params = JSON.stringify(obj);
    console.log(params);
    xhr.send(params);
}


console.log('running');
</script>
