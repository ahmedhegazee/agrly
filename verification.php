<?php
if(isset($_GET['email'])&&isset($_GET['hash'])){
    $uid=$_GET['email'];
    $hash=$_GET['hash'];
    global $db;
    $db=mysqli_connect("localhost","root","","agrly");
    $sql="SELECT * FROM Verification WHERE email='$uid' and code='$hash';";
    
    $result = mysqli_query($db,$sql);
//print_r($result) ;
//echo mysqli_num_rows($result)>0;
       if(mysqli_num_rows($result)>0)
       {
           
        $sql="delete from  Verification where email = '$uid';";
       
    
        $result = mysqli_query($db,$sql);
        $sql="update Users set verified=1 where useremail='$uid';";
        $result = mysqli_query($db,$sql);

        echo "<script>alert('you are verified successfully');</script>";
       header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
       }
       else{
           echo "please contact support for verification";

       }
        
    
}
else{
//header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
}
?>