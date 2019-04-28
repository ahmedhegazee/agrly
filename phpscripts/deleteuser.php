<?php
if(isset($_POST['usid']))
{
    $db=mysqli_connect("localhost","root","","agrly");
 $uid=$_POST['usid'];
 $sql="delete from Apartements where userid = '$uid';";
 $result = mysqli_query($db,$sql);
 $sql="delete from Users where userid = '$uid';";
 $result = mysqli_query($db,$sql);
 $file= dirname(__DIR__)."/agrly/profileimg/prof".$uid.".jpg";
 $progimg="../profileimg/prof".$uid.".jpg";
 if(file_exists($file))
 {
     chmod($file,0755);
     unlink($file);
 }
 print_r($result);
 exit;
}
?>