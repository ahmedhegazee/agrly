<?php
if(isset($_POST['email']))
{
    $db=mysqli_connect("localhost","root","","agrly");
 $email=$_POST['email'];
 
 $sql="select useremail from Users where useremail = '$email';";
 $result = mysqli_query($db,$sql);
 
 while($row=mysqli_fetch_array($result))
 {
  echo $row["useremail"];
 }
 exit;
}
?>