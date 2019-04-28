<?php
if(isset($_GET['id']))
{    global $apartid;
    $db=mysqli_connect("localhost","root","","agrly");
    $apartid=$_GET['id'];
    $sql="Delete from Apartements where apartid='$apartid'";
    $result = mysqli_query($db,$sql);
    $target_dir=dirname(__DIR__,1)."/apartimg/";
    $storedFileName=$target_dir."apart".$aprtid.".jpg";
            if (file_exists($storedFileName)) 
            {
                chmod($storedFileName,0755);//changes the file permission to write / execute
                unlink($storedFileName);
                }
                header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
}
else{

 header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
}
?>