<?php
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["email"])){
    
    $tel=$_POST["email"];
        if(check_email($tel)){
            $arr["errorm"]=false;
            $arr["message"]="The email is not registered";
        }
    else{
        $arr["errorm"]=true;
        $arr["message"]="email is  registered";
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