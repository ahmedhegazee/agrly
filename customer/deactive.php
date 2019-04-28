<?php
session_start();
global $uid;
if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
 $uid =$_SESSION["uid"];
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Agerly | Account</title>
 <link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    margin-top:70%;
}

#footer ul{
    margin:10px auto;
    width:27%;
    list-style: none;
    left:0;
    font-size: 2em;
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
</style>
</head>

<?php
include '../master.php';
?>    
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">

    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container" style="
    height: 100px; ">
    <h1><b>My Apartements</b></h1>
    </div>
  </header>
  
<div style="height:500px">

<label>Do you want to deactive your account.</label>
<input type="text" id="deactive" name="deactive" placeholder="Write Deactive Account"/><span id="msg"><i class="fas fa-exclamation-circle"></i></span><br/>
<button id="btn" class="btn" onclick="deactive();">Deactive Account</button>
</div>
  
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
<script type="text/javascript" src="../scripts/jquery.js"></script>
    <script type="text/javascript">
    "use strict";
    var email = document.getElementById("deactive"),
    button =document.getElementById("btn"),
    msg=document.getElementById("msg");
    btn.style.display="none";
    email.onkeydown=function(){
        if(email.value!="Deactive Account"){
            msg.style.display="inline";
                msg.style.color="#F00";
        }else{
            msg.style.color="#080";
            btn.style.display="block";
        }
    }
    function deactive () {
if(confirm("Do you want to delete your account?")){
    $.ajax({
    type: 'post',
     url: '../phpscripts/deleteuser.php',
     data: {
            usid:<?php echo intval($uid)?>
     },
     success: function (response) { 
if(respones==1){
    alert("The acoount is deleted");
    location.reload();
}
else{
    alert("The acoount is not deleted");
}
     }
    });
}

};
        

    
 </script>


</body>
</html>
