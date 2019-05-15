<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $db = mysqli_connect("localhost","root","","agrly");
    $sql  ="select * from Govern";
    $result = mysqli_query($db,$sql);
    
    $data = array();
    while($row = mysqli_fetch_array($result)){
      /*  $govern =array(
            "Govern"=>$row["GovernName"],
            //"Value"=> $row["GovernID"]

        );*/
        array_push($data,$row["GovernName"]);
    }
    array_push($data,"all");
    $output=array();
    $output["Governs"]=$data;
    echo json_encode($output);
}

?>