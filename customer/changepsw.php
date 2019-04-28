<?php
session_start();

if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
$uid =$_SESSION["uid"];

if(isset($_POST["form"]))
{
    $db=mysqli_connect("localhost","root","","agrly");
    
    $password =$_POST["pass"];

    $sql="update Users set  userpasswod='$password' where userid='$uid';";
    $result = mysqli_query($db,$sql);
    echo "<script>alert('Your password is changed.');</script>\n";
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
</head>
<?php
include '../master.php';
?>
<script src="../agrly/scripts/validationpass.js"></script>
<form method="post" id="form" action="changepsw.php">
<div class="content" style="color:#000">
    
<div><label>Password</label>
    <input type=password id="pass"   name=pass required placeholder="Password"/><span id="msgp"><i class="fas fa-exclamation-circle"></i></span>
    </div>
              <div><label>Confirm Password</label>
    <input type=password  id="passconf"   name=cnpass required placeholder="Password"/><span id="msgcp"><i class="fas fa-exclamation-circle"></i></span>
    </div>    
     <button type="submit" Class="btn">Change Password</button>
</div> 
</form>
       <form method="post" id="psw" action="changepsw.php">
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
        <script src="../scripts/validationpass.js"></script>
</body>
</html>
