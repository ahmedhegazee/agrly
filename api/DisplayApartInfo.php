<?php
global $uid,$token;
require_once "UserOperation.php";
$arr=array();
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["apartid"])){
    
    $apartid=intval($_POST["apartid"]);
   
    $arr["error"]=false;
    $arr["data"]=displayApartInfo($apartid);

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