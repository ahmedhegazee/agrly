<?php
global $uid;
//check for the request
if($_SERVER["REQUEST_METHOD"]==="POST"){

if(isset($_POST["uid"])
and isset($_POST["op"])
){
    
    $uid=$_POST["uid"];
    $op=$_POST["op"];
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