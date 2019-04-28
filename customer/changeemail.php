<?php
session_start();
global $uid;
if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
$uid =$_SESSION["uid"];

if(isset($_POST["form"]))
{
    $db=mysqli_connect("localhost","root","","agrly");
    
    $email=$_POST["email"];

    $sql="update Users set  useremail='$email' where userid='$uid';";
    $result = mysqli_query($db,$sql);
    echo "<script>alert('Your email is changed.');</script>\n";
    header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Change Password | Agerly</title>
<link rel=stylesheet href="../css/normalize.css"/>
<link rel=stylesheet href="../css/all.min.css"/>
<link rel=stylesheet href="../css/change.css"/>
 <link rel="stylesheet" href="../css/w3.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel=stylesheet href="../css/all.min.css"/>
   <link rel=stylesheet href="../css/profile.css"/>
    <style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
        .w3-bar .w3-button {
    white-space: normal;
            color: #000;}
body{margin-top:-46px;}

#footer{
    padding-top:10px;
    background-color: #AAA;
    text-align: center;
    height: 110px;
    color:#fff;
    font-size:1.2em;
        margin-top: 28%;
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
        .content{    margin-top: 50px;}
        .content div input >span{
    display: none;
    margin-left: 65%;
    color:#F00;
}
</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">


 window.onload=function(){
    "use strict";
    var email = document.getElementById("txtemail"),
        cemail = document.getElementById("txtcemail"),
        oldemail = document.getElementById("txtoldemail"),
        msg = document.getElementById("msgemail"),
        oldmsg = document.getElementById("msgoldemail"),
        form = document.getElementById("form");
        cemail.onkeydown=function(){
            if (email.value != cemail.value||email.value==''||cemail.value=='')
            {
                
                msg.style.display="inline";
                msg.style.color="#F00";
                if(!form.hasAttribute("onsubmit"))
                form.setAttribute("onsubmit","event.preventDefault();");
    
            }
            else{
                msg.style.color="#080";
                if(form.hasAttribute("onsubmit"))
                form.removeAttribute("onsubmit");
    
            }
    
        };
        oldemail.onkeydown=function() {
            var emailvalue,oldemailvalue;
            $.ajax({
    type: 'post',
     url: 'checkemail.php',
     data: {
            uid: <?php echo $uid?>
     },
     success: function (response) {
         oldemailvalue = response;
         emailvalue = oldemail.value;
        console.log(emailvalue);
        console.log(oldemailvalue)
        if (emailvalue != oldemailvalue) {
                oldmsg.style.display="inline";
                oldmsg.style.color="#F00";
                if(!form.hasAttribute("onsubmit"))
                form.setAttribute("onsubmit","event.preventDefault();");
    
            }
            else{
                oldmsg.style.color="#080";
                if(form.hasAttribute("onsubmit"))
                form.removeAttribute("onsubmit");
    
            }
        }
     }
 );
        
        };
 };
        
 </script>
</head>
<?php
include '../master.php';
//echo $uid;
?>

<form method="post" id="form" action="changeemail.php">
<div class="content" style="color:#000">
<div><label>Old Email</label>
            <input ID="txtoldemail" type="email" name="email"  required placeholder="Old Email"  ><span id="msgoldemail"><i class="fas fa-exclamation-circle"></i></span>
        </div>
<div><label>New Email</label>
            <input ID="txtemail"  type="email" name="email" required placeholder="New Email"  >
        </div>
        <div><label>Confirm Email</label>
            <input ID="txtcemail" type="email" required placeholder="Confrim Email"  ><span id="msgemail"><i class="fas fa-exclamation-circle"></i></span>
        </div>   
     <button type="submit" Class="btn">Change Password</button>
</div> 
</form>
       
</div>
<div style="clear:both"></div>
        
<footer id="footer">
  <div>Copyrights 2018 &copy; Egy Tour</div>  
  <ul>
      <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
      <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
      <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
  </ul>
</footer>
        </form>
        
</body>
</html>
