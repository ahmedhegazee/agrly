<?php
if(isset($_POST['usid']))
{
    $db=mysqli_connect("localhost","root","","agrly");
 $uid=$_POST['usid'];
 
 $sql="update  Users set verified=0 where userid = '$uid';";
 $result = mysqli_query($db,$sql);
 print_r($result);
 exit;
}
?>