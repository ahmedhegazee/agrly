<?php
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["tel"])){
    
    $tel=intval($_POST["tel"]);
        if(check_tel($tel)){
            $arr["errorm"]=false;
            $arr["message"]="The mobile phone is not registered";
        }
    else{
        $arr["error"]=true;
        $arr["message"]="mobile phone is  registered";
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