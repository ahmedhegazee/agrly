<?php
global $id,$fn,$ln,$tel,$govern,$city,$price,$rooms;
global $bath,$kitchen,$desc;
if(isset($_GET["id"]))
$id=intval($_GET["id"]);
else
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
$db=mysqli_connect("localhost","root","","agrly");
$sql1="SELECT apartid,apartdescription,price,numOfRooms,numOfKitchen,numOfBathrooms,u.firstname,u.lastname,u.usertel,g.GovernName,c.CityName 
  FROM ((Apartements a join Users u on a.userid=u.userid)
  join Govern g on a.govern = g.GovernID) join City c on a.city=c.CityID 
  WHERE a.apartid=$id;";
   $result1 = mysqli_query($db,$sql1);
    $index=1;
   $myrow = mysqli_fetch_array($result1);
$fn=$myrow["firstname"];
$ln=$myrow["lastname"];  
$tel=$myrow["usertel"];
$govern=$myrow["GovernName"];
$city=$myrow["CityName"];
$price=$myrow["price"];
$rooms=$myrow["numOfRooms"];
 $bath=$myrow["numOfBathrooms"];
 $kitchen=$myrow["numOfKitchen"];
 $desc=$myrow["apartdescription"];
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>Agerly | Details</title>
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
    margin-top:60%;
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
           margin-top:50px;
            width: 78%;
            margin-left: 19%;
        }
        .content div{
            border:2px solid #AAA;
        } 
        .content div label{    display:block;}
        .content div:first-of-type{
            border:none;
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
         ul {list-style: none;}
         ul li {display:block;}
        button{
    background-color: transparent;
    border: 0;
    font-size:2em;
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


</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
function goBack(){
    history.back();
}
function addApart(apart)
{
    
    
 $.ajax({
 type: 'post',
 url: '../phpscripts/addCart.php',
 data: {
  apartid:apart
 },
 success: function (response) {
  if(response==1)
  {
      alert ("the item is added to cart");
      location.replace("http://localhost:8080/agrly/visitor/result.php");
  }
  
 }
 });
};
</script>
</head>
<body class="w3-light-grey w3-content" style="max-width: 1688px;">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    </div>
  <div class="w3-bar-block">
      
  
            <div>
                <ul>
                    <li><button onclick="addApart(<?php echo intval($id);?>)">Add to Wished List</button></li>
                   <li><button onclick="goBack()">Go To Results</button></li>
                </ul>
                
            </div>
   </div>
  
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">

    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container" style="
    height: 100px; ">
    <div class="content" style="color:#000">
   <div>
   <?php echo'<img src="'."../apartimg/apart".$id.'.jpg"   style="width:200px;height:200px;margin-left: 30%; margin-bottom: 5%;"  />';?></div>
       <div><label>Apartement Owner</label>
  <span><?php echo $fn." ".$ln;?></span> </div>
       <div><label>Owner Mobile</label>
       <span> <?php echo $tel;?></span></div>
       <div><label>Government</label>
       <span><?php echo $govern;?> </span>      </div>
       <div><label>City</label>
             <span><?php echo $city;?></span>   </div>
       <div><label>Price</label>
              <span><?php echo $price." L.E";?> </span>  </div>
           <div><label>Number of Rooms</label>
           <span><?php echo $rooms ." Rooms";?></span></div>
           <div><label>Number of Kitchen</label>
               <span><?php echo $kitchen." Kitchens";?></span></div>
           <div><label>Number of Bathrooms</label>
               <span><?php echo $bath." Bathrooms";?></span></div>
       <div><label>Apartement Description</label>
           <span><?php echo $desc;?> </span></div>
   </div> 
   </div>
   
</header>
</div>

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
<script src="../scripts/editapart.js"></script>


</body>
</html>
