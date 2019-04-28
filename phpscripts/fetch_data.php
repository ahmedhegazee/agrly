<?php
if(isset($_POST['get_option']))
{
    $db=mysqli_connect("localhost","root","","agrly");

 $govern = $_POST['get_option'];
 $sql="select CityName,CityID from City where govern='$govern'";
 $result = mysqli_query($db,$sql);
 while($row=mysqli_fetch_array($result))
 {
  echo "<option value=".$row['CityID'].">".$row["CityName"]."</option>";
 }
 exit;
}
?>