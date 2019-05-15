<?php
global $uid,$token;
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["token"])
){
    
    $token=$_POST["token"];
    
    //check the if the user is registerd or not.
    $arr["error"]=false;
        $arr["Apartements"]=displayUserApart($token);
        }
else{
    $arr["error"]=true;
$arr["message"]="Data is not completed";
}
}
else{
$arr["error"]=true;
$arr["message"]="Wrong Request";
}
echo json_encode($arr);
?>