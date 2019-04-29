<?php

$uid =$_SESSION["uid"];

$db=mysqli_connect("localhost","root","","agrly");
$sql="SELECT username,firstname,lastname FROM Users WHERE userid='$uid';";

$result = mysqli_query($db,$sql);
    $myrow = mysqli_fetch_array($result);
    $username=$myrow["username"];
    $firstname= $myrow["firstname"];
    $lastname=$myrow["lastname"];
echo '<body class="w3-light-grey w3-content" style="max-width: 1688px;">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>';
   
    $file= dirname(__DIR__)."/profileimg/prof".$uid.".jpg";
    $progimg="../profileimg/prof".$uid.".jpg";
    if(file_exists($file)){
      echo '<img  id="pimg" src="'.$progimg.'" style="width:45%;" class="w3-round">';
    }
    else
    echo '<img  id="pimg" src="../img/Ahmed.png" style="width:45%;" class="w3-round">';
    
    echo '
    <br><br>
    
     <h4><b><div id="fn" class="fullname" >'; echo $firstname." ".$lastname;
     echo '</div></b></h4>
    <p class="w3-text-grey"><div id="un" class="username" >'; echo $username;
    echo'</div></p>
      
            
  </div>
  <div class="w3-bar-block">
    <a href="cpanel.php"  class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Users Information</a> 
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fas fa-comments w3-margin-right"></i>Chat</a>
  <a href="  logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fas fa-sign-out-alt w3-margin-right"></i>Log Out</a>
      
  </div>
  
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
';

?>