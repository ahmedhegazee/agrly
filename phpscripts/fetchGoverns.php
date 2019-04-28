<?php
$db=mysqli_connect("localhost","root","","agrly");


$sql="select * from Govern ;";
$result = mysqli_query($db,$sql);

while($row=mysqli_fetch_array($result))
{
    echo "<option value=".$row['GovernID'].">".$row["GovernName"]."</option>";
}
exit;
?>