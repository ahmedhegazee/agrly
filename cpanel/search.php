<?php
session_start();
global $uid;
global $s;
if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
 $uid =$_SESSION["uid"];

 if(isset($_GET["s"])){
     $search = intval($_GET["s"]);
 }
 else{
    header( "refresh:0.2;url=http://localhost:8080/agrly/cpanel/cpanel.php");  
 }
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Agerly | Control Panel</title>
 <link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel=stylesheet href="../css/style.css"/>
   <link rel=stylesheet href="../css/all.min.css"/>
   <link rel=stylesheet href="../css/profile.css"/>
    <style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
        .w3-bar .w3-button {
    white-space: normal;
            color: #000;}
        .w3-third{
            position:relative;
            padding-bottom: 40px;
        }
        .w3-third .span{
            display:none;
                position: absolute;
    top: 25%;
    left: 32%;
    color: #fff;
    font-size: 1.4em;
        }
            .w3-third .id {
                display: none;
            }
#footer{
    padding-top:10px;
    background-color: #AAA;
    text-align: center;
    height: 110px;
    color:#fff;
    font-size:1.2em;
    margin-top:30%;
}

#footer ul{
    margin:10px auto;
    width:27%;
    list-style: none;
    left:0;
    font-size: 1.2em;
}
#footer ul li i{
    color:#000;
}
#footer ul li
{
    float:left;
    margin-left:10px;
    
}
#footer ul li a i:hover{
    color:#fff;
}
.red{ background-color:#ff0000;}
    .green{background-color:#00ff21}
    .yellow{background-color:#ffd800}
.circle {
    border-radius: 50%;
    width: 10px;
    height: 10px;
    display: inline-block;
    position: absolute;
    left: 10%;
    top: 24%;
}   
.ws{    position: absolute;
    left: 17%;
    top: 23%;}
        .content {
            text-align: center;
            width: 78%;
            margin-left: 19%;
        } 
        td{
            border: 2px solid #F00;
        }
        input[type="button"]{
            background-color: transparent;
            border:0;
        }
        form{
            margin-top:-3%;
            text-align:left;
        }
</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script >
    
        
        function deleteu (uid) {
if(confirm("Do you want to delete this user?")){
    $.ajax({
    type: 'post',
     url: '../phpscripts/deleteuser.php',
     data: {
            usid:uid
     },
     success: function (response) { 
if(respones==1){
    alert("The user is deleted");
    location.reload();
}
else{
    alert("The user is not deleted");
}
     }
    });
}
};
function deactive(uid){
    if(confirm("Do you want to delete this user?")){
    $.ajax({
    type: 'post',
     url: '../phpscripts/deactiveuser.php',
     data: {
            usid:uid
     },
     success: function (response) { 
if(respones==1){
    alert("The user is deactived");
    location.reload();
}
else{
    alert("The user is not deactived");
}
     }
    });
}

};
function sendverification(uid,ver){
    if( ver!=1){
        $.ajax({
    type: 'post',
     url: '../phpscripts/sendverification.php',
     data: {
            email:uid
     },
     success: function (response) { 

    alert("Verification code is sent successfully");


}
    });
    }
    else{
        alert("The user is already verified");
    }
    };
    
    function verifyuser(uid,ver){
       if(ver!=1)
        {
            if(confirm("Do you want to verify this user?")){
    $.ajax({
    type: 'post',
     url: '../phpscripts/verifyuser.php',
     data: {
            usid:uid
     },
     success: function (response) { 
if(respones==1){
    alert("The user is verified");
    location.reload();
}
else{
    alert("The user is not verified");
}
     }
    });
}}
else{
    alert("this user is verified");
}
    };
</script>
</head>

<?php
include 'master.php';
?>    
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">

    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container" style="
    height: 100px; ">
    <h1><b>Users</b></h1>
    <br/><form action="search.php" method="get">
        <input type="search" name="s" placeholder="Search by phone number"/>
    </form>
    </div>
  </header>
  <?php

  $db=mysqli_connect("localhost","root","","agrly");
  $sql="select * from Users where usertel='$search'";
    $result = mysqli_query($db,$sql);
    if($myrow==null)
    echo"<div style='height:400px;'></div>";
    
echo"<table>";
echo"<tr><td>User ID</td><td>User Name</td><td>First Name</td><td>Last Name</td>";
echo"<td>User Email</td><td>User Tel</td><td>Verified</td>";
echo"<td>Delete</td><td>Deactive</td><td>Send Code</td>
<td>Verify</td></tr>";
  while($myrow = mysqli_fetch_array($result))
  {
    echo"<tr>";
    echo"<td>".$myrow["userid"]."</td>";
    echo"<td>".$myrow["username"]."</td>";
    echo"<td>".$myrow["firstname"]."</td>";
    echo"<td>".$myrow["lastname"]."</td>";
    echo"<td>".$myrow["useremail"]."</td>";
    echo"<td>".$myrow["usertel"]."</td>";
    echo"<td>".$myrow["verified"]."</td>";
   // echo"<td><a  href='http://localhost:8080/agrly/cpanel/edituser.php?uid=".$myrow["userid"]."'>Edit User</a></td>";
    echo"<td><input type=button value='Delete User' onclick='deleteu(".$myrow["userid"].");'/></td>";
    echo"<td><input type=button value='Deactive User' onclick='deactive(".$myrow["userid"].");'/></td>";
    $uemail=$myrow["useremail"];
    $verified=$myrow["verified"];
    echo"<td><input type=button value='Send Verification' onclick="."\"sendverification('$uemail','$verified');\"/></td>";
    echo"<td><input type=button value='Verify' onclick="."\"verifyuser('$uemail','$verified');\"/></td>";
    echo "</tr>";
    
  }
echo "</table>";
  ?>
 

    <footer id="footer">
  <div>Copyrights 2018 &copy; Egy Tour</div>  
  <ul>
      <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
      <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
      <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
  </ul>
</footer>
    
<!-- End page content -->
</div>



</body>
</html>
