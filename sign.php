<?php
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    $db=mysqli_connect("localhost","root","","agrly");
    if(isset($_POST["sign"]) )
    {$un=$_POST["un"];
    $pass =$_POST["pass"];
    
    $sql="SELECT userid,verified FROM Users WHERE username='$un'and userpassword='$pass';";
    $result = mysqli_query($db,$sql);
    $myrow = mysqli_fetch_array($result);
    $uid=$myrow["userid"];
    $verified =$myrow["verified"];
   
    if($uid==null)
    echo"<script>alert('your are not registered');</script>";
    else
  {
      if($verified!=1)
      echo"<script>alert('your are not verified. check your email');</script>";
      else if($verified==1) {
         header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
       session_start();
         $_SESSION["uid"]=$uid;
       
      }
      
 
  } 
}
else if(isset($_POST["register"]))
{
    $first =$_POST["fn"];
    $last =$_POST["ln"];
    $user =$_POST["unr"];
    $password =$_POST["passr"];
    $email =$_POST["email"];
    $tel =$_POST["tel"];
    $sql="INSERT INTO Users (firstname, lastname, username, useremail, userpassword,usertel) VALUES ('$first','$last','$user','$email','$password',$tel);";
    $result = mysqli_query($db,$sql);
    echo "<script>alert('Thank you! Check Your email for verification code.');</script>\n";
    header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
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

<link rel=stylesheet href="css/framework.css"/>
<link rel=stylesheet href="css/normalize.css"/>
<link rel=stylesheet href="css/all.min.css"/>
<link rel=stylesheet href="css/style.css"/>
<title>Agerly</title>
    <style>.content-container{height: auto;}
    input[type="number"] {
    margin-left: 0;
    color: #fff;
}
.signup span {
    display: inline;
}
    </style>
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script>
    function sendverification(){
        var emailVal =document.getElementById('txtemail').value;
        console.log(emailVal);
   $.ajax({
    type: 'post',
     url: 'phpscripts/sendverification.php',
     data: {
            email:emailVal
     },
     success: function (response) { 
if(respones==1){
    alert("Verification code is sent successfully");
}
}});
}
    </script>
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
            <form action="sign.php" method="POST">
            <input type="text" name="un" placeholder="username" required/><br/>
            <input type='password' name="pass" placeholder="password" required/><br/>
           <button id="sign" type="submit" name="sign" class="btn">Log In</button>
        </form>
        </div>
        <div class="signup">
            <h2>Signup</h2>
            <form id="form"  action="sign.php" method="POST">
            <input type="text" placeholder="First Name" name="fn" required/><span id="msg1"></span>
             <input type="text" placeholder="Last Name" name="ln" required/><span id="msg2"></span> <br/>
            <input type="text" name="unr" placeholder="User Name" required/><span id="msg3"></span><br/>
            <input id="pass" type='password' name="passr" placeholder="Password" required/><span id="msgp"><i class="fas fa-exclamation-circle"></i></span><br/>
              <input id="passconf" type='password' name="cpass" placeholder="Confirm Password" required/><span id="msgcp"><i class="fas fa-exclamation-circle"></i></span><br/>
                <input type='email' name="email" id="txtemail" placeholder="Email" required/><span id="msgemail"><i class="fas fa-exclamation-circle"></i></span><br/>
                <input id="txttel" type="number" name="tel" placeholder="Mobile Number" required/><span id="msgtel"><i class="fas fa-exclamation-circle"></i></span><br/>
                <button id="register" onclick="sendverification();" type="submit" name="register"  class="btn">Sign Up</button>
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
<script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript">
    "use strict";
    var email = document.getElementById("txtemail"),
         msg = document.getElementById("msgemail"),
        form = document.getElementById("form");
        email.onkeyup=function() {  
            $.ajax({
    type: 'post',
     url: 'phpscripts/findemail.php',
     data: {
            email:email.value
     },
     success: function (response) { 
        if (response ==email.value && email.value!=" ") {

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
        }
     }
 );
        };
 </script>
<script >
window.onload=function (){
    "use strict";
    var password = document.getElementById("pass"),
    cpassword = document.getElementById("passconf"),
    msgp = document.getElementById("msgp"),
    msgcp = document.getElementById("msgcp"),
        form = document.getElementById("form");
    
    
    password.onkeyup=function(){
        console.log(password.value);
        if(password.value.length<7)
        {
            
            msgp.style.display="inline";
            msgp.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");
        }
        else{
            msgp.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");
        }
    };
    cpassword.onkeyup=function(){
        if (password.value != cpassword.value)
        {
            msgcp.style.display="inline";
            msgcp.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");

        }
        else{
            msgcp.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");

        }
    }
    var tel =document.getElementById("txttel"),
    msgtel = document.getElementById("msgtel"),
        form = document.getElementById("form");
    tel.onkeyup=function(){
        msgtel.style.display="inline";
        if (tel.value.length==11)
        {
            //console.log("finish");
            msgtel.style.color="#080";
            if(form.hasAttribute("onsubmit"))
            form.removeAttribute("onsubmit");
        }
        else{
            //console.log(tel.textContent);
            msgtel.style.color="#F00";
            if(!form.hasAttribute("onsubmit"))
            form.setAttribute("onsubmit","event.preventDefault();");
        }
    };
}
</script>

</body>
</html>