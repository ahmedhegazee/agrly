<?php
if(isset($_POST['uid']))
{
    $db=mysqli_connect("localhost","root","","agrly");
 $uid=$_POST['uid'];
 
 $sql="select useremail from Users where userid='$uid';";
 $result = mysqli_query($db,$sql);
 while($row=mysqli_fetch_array($result))
 {
  echo $row['useremail'];
 }
 exit;
}
?>