<?php
if(isset($_POST['usid'])){
    $uid=$_GET['usid'];
    global $db;
    $db=mysqli_connect("localhost","root","","agrly");
        $sql="delete from  Verification where email = '$uid';";
       
    
        $result = mysqli_query($db,$sql);
        $sql="update Users set verified=1 where useremail='$uid';";
        $result = mysqli_query($db,$sql);

        echo 1;
        
    
}
?>