<?php
/*
 * First checks the request 
 * The checks if the data is correct. 
 * After that check the user's registration. 
 * Finally generate the access token
 */
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["token"])){
    
    $token=$_POST["token"];
   
        $userid=check_token($token);
        if($userid!="No Token"){
            $arr["error"]=false;
            $arr["message"]="Token is right";
            $arr["data"]=displayUserInfo($userid);
        }
        else{
            $arr["error"]=true;
            $arr["message"]="Token is wrong";
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
