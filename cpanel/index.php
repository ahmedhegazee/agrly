<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    $db=mysqli_connect("localhost","root","","agrly");
    if(isset($_POST["sign"]) )
    {$un=$_POST["un"];
    $pass =$_POST["pass"];
    
    $sql="SELECT userid,verified,isAdmin FROM Users WHERE username='$un'and userpassword='$pass';";
    $result = mysqli_query($db,$sql);
    $myrow = mysqli_fetch_array($result);
    $uid=$myrow["userid"];
    $verified =$myrow["verified"];
    $isAdmin=$myrow["isAdmin"];
    if($uid==null)
    echo"<script>alert('your are not registered');</script>";
    else
  {
      if($isAdmin!=1)
      echo"<script>alert('your are not an admin');</script>";
      else if($isAdmin==1 && $verified==1 ) {
        header( "refresh:0.2;url=http://localhost:8080/agrly/cpanel/cpanel.php");
      session_start();
        $_SESSION["uid"]=$uid;
      
     }
  } 
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel=stylesheet href="../css/framework.css"/>
<link rel=stylesheet href="../css/normalize.css"/>
<link rel=stylesheet href="../css/all.min.css"/>
<link rel=stylesheet href="../css/style.css"/>
<title>Agerly</title>
    <style>.content-container{height: auto;}
    input[type="number"] {
    margin-left: 0;
    color: #fff;
}
.login{
    margin: 2px 26%;
}
footer{
    margin-top:30%;
}
    </style>
</head>
<body>

<div class="content-container">
    <nav>
    <div class="container">
      <h2><a href="Home.html">Agerly</a></h2>
       
        <ul>
            <li><a href="Home.html">Home</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">Contact</a></li>
             <li><a href="sign.php">Login/singup</a></li>
        </ul>
    </div>
</nav>
<section>
    <div class="container">
        <div class="login">
            <h2>Login</h2>
            <form action="index.php" method="POST">
            <input type="text" name="un" placeholder="username" required/><br/>
            <input type='password' name="pass" placeholder="password" required/><br/>
           <button id="sign" type="submit" name="sign" class="btn">Log In</button>
        </form>
        </div>
    </div>
</section>
<footer>
   <div class="container">
   <div>
      Copyrights &copy; 2019 <br>
    Dev. Ahmed Hegazy 
   </div>
    <ul>
        <li><a href="#"><i class="fab fa-facebook "></i></a></li>
                <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
    </ul>
    </div>
</footer>
</div>
</body>
</html>