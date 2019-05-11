
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Agerly | Search</title>
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
    height: 130px;
    color:#fff;
    font-size:1.2em;
    margin-top:50%;
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
        .content {
            text-align: center;
            width: 78%;
            margin-left: 19%;
        } 
        .btn{
            text-decoration: none;
    background-color: #000;
    color: #fff;
    padding: 10px 20px;
    font-size: 1.5em;
    border-radius: 41px;
    top: 3%;
    right: 2%;
    position: absolute;
        }
        .w3-padding-32{
            margin-top: 40%;
        }
        form ul {list-style: none;}
        form ul li {display:block;}
        button{
    background-color: transparent;
    border: 0;
    font-size:2em;
    margin-left: 30%;
}
        select, input[type="number"] {
            width: 230px;
    height: 30px;
    font-size: 1em;
    border: 0;
    border-bottom: 2px solid #000;
    border-radius: 0;
    background-color: transparent;
    margin-bottom: 10%;
}
.w3-third{
    background-color: #fff;
text-align: center;
}
#delete{
    background-color: #F00;
    margin:0;
    padding: 10px 20px;
    font-size: 1.5em;
    border-radius: 41px;
    color:#fff;
}
</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">

function deleteAprt(apart)
{
    
    
 $.ajax({
 type: 'post',
 url: '../phpscripts/deleteCart.php',
 data: {
  apartid:apart
 },
 success: function (response) {
  if(response==1)
  {
      alert ("the item is deleted from cart");
      location.replace("http://localhost:8080/agrly/visitor/result.php");
  }
  
 }
 });
};
</script>

</head>
<body class="w3-light-grey w3-content" style="max-width: 1688px;">


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  
<!-- !PAGE CONTENT! -->
<div class="w3-main"  >

  <!-- Header -->
  <header id="portfolio">

    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container" style="
    height: 100px; ">
    <h1 style="text-align: center;"><b>Wished Apartements</b></h1>
    </div>
    <a href="../phpscripts/pdfgenerator.php" class="btn">Print</a>
  </header>
  <?php

  session_start();
  if(isset($_SESSION['cart']) ){
	//$items = $_SESSION['cart'];
	$cartitems = $_SESSION['cart'];
    if(count($cartitems)==0){
        echo "<script>alert('You don't have Wished Apartemnets')</script>";
        header( "refresh:0.2;url=http://localhost:8080/agrly/visitor/result.php");
    }
    else{
        $db=mysqli_connect("localhost","root","","agrly");
        foreach($cartitems as $id){
            $aid=intval($id);
            $sql1="SELECT apartid,apartdescription,price,u.firstname,u.lastname,u.usertel,g.GovernName,c.CityName 
            FROM ((Apartements a join Users u on a.userid=u.userid)
            join Govern g on a.govern = g.GovernID) join City c on a.city=c.CityID 
            WHERE a.apartid=$aid";
             $result1 = mysqli_query($db,$sql1);
             $myrow = mysqli_fetch_array($result1);
             
            echo'<div class="w3-third w3-container">';
            echo'<img src="'."../apartimg/apart".$myrow["apartid"].'.jpg"   style="width:100%;"      CssClass="w3-hover-opacity"/>';
            echo' <p><b ><span >'.$myrow["firstname"]." ".$myrow["lastname"].'</span></b></p> ';
            echo' <p><b ><span >'.$myrow["GovernName"]." ".$myrow["CityName"].'</span></b></p> ';
            echo '<p ><span>'.$myrow["usertel"].'</span></p>';
            echo '<p ><span>'.$myrow["price"].'L.E<br/>'.$myrow["apartdescription"].'</span></p>';
            echo '<button id="delete" onclick="deleteAprt('.intval($myrow["apartid"]).')">Delete</button></div></div>';
        }
    }
      }
  ?>
 

  

  <footer id="footer">
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
    
<!-- End page content -->
</div>


</body>
</html>
