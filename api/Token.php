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

if(isset($_POST["userid"])){
    
    $userid=$_POST["userid"];
    if(check_userid($userid)){
        $token=check_found_token($userid);
        if($token!="No Token"){
            $arr["error"]=false;
            $arr["message"]=$token;
        }
        else{
            $token =generate_token($userid);
            $arr["error"]=false;
            $arr["message"]=$token;
        }
    }
    else{
        $arr["error"]=true;
        $arr["message"]="You are not registered";
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
