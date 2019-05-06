<?php
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["username"])){
    
    $username=$_POST["username"];
        if(check_username($username)){
            $arr["errorm"]=false;
            $arr["message"]="The username is not registered";
        }
    else{
        $arr["errorm"]=true;
        $arr["message"]="username is  registered";
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