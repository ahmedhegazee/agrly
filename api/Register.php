<?php
/* */
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["username"])
and isset($_POST["password"])
and isset($_POST["email"])
and isset($_POST["tel"])
and isset($_POST["firstname"])
and isset($_POST["lastname"])
){
    
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $usertel=$_POST["tel"];
    //check for the phone and email
    if(check_tel($usertel)&&check_email($email)){
        //register the user
        if(register($firstname,$lastname,$username,$password,$email,$usertel)&&send_verification($email)){
        $arr["error"]=false;
        $arr["message"]="Successful Registration.Check your email";
        }
        else{
            $arr["error"]=true;
            $arr["message"]="Error in registering";
        }
    }
    else{
        $arr["error"]=true;
        $arr["message"]="The email or Phone is found";
    }
    
}
else{
    $arr["error"]=true;
$arr["message"]="Data is not completed";
}
}else{
$arr["error"]=true;
$arr["message"]="Wrong Request";
}
echo json_encode($arr);
?>