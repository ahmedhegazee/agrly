<?php
global $uid,$token;
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["username"])
and isset($_POST["password"])
){
    
    $username=$_POST["username"];
    $password=$_POST["password"];
    //check the if the user is registerd or not.
$uid =sign($username,$password);
    if($uid>0){
        //register the user
        if(check_verification($username,$password)){
        $arr["error"]=false;
        $arr["message"]="Welcome";

        $token=check_found_token($uid);
        if($token!="No Token"){
            $arr["error"]=false;
            $arr["data"]=$token;
        }
        else{
            $token =generate_token($uid);
            $arr["error"]=false;
            $arr["data"]=$token;
        }
      //  $arr["Apartements"]=displayUserApart($token);
        }
        else{
            $arr["error"]=true;
            $arr["message"]="You are not verified";
        }
    }
    else{
        $arr["error"]=true;
        $arr["message"]="you ar not registered";
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