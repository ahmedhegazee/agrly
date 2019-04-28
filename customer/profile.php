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
    <a href="AddApartement.php" class="btn">Add Apartement</a>
  </header>
  <?php
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
global $pageno;
global $total_pages;
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page; 
  $db=mysqli_connect("localhost","root","","agrly");
  $total_pages_sql = "SELECT COUNT(*) FROM Apartements where userid='$uid';";
$result = mysqli_query($db,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];

$total_pages = ceil($total_rows / $no_of_records_per_page);
  $sql1="SELECT apartid,apartdescription,price,u.firstname,u.lastname,g.GovernName,c.CityName 
  FROM ((Apartements a join Users u on a.userid=u.userid)
  join Govern g on a.govern = g.GovernID) join City c on a.city=c.CityID 
  WHERE a.userid=$uid LIMIT $offset, $no_of_records_per_page;";
    $result1 = mysqli_query($db,$sql1);
    $index=1;
    
    if($myrow==null){
        echo "<div style='height:450px'></div>";
    }
    
    while($myrow = mysqli_fetch_array($result1))
    {
      if($index==6)
        break;
      echo '<a href="EditApart.php?id='.$myrow["apartid"].'">';
      echo'<div class="w3-third w3-container">';
      echo'<img src="'."../apartimg/apart".$myrow["apartid"].'.jpg"   style="width:100%"  onmouseover="show('.($index-1).');" onmouseout="hide('.($index-1).');"   CssClass="w3-hover-opacity"/>';
      echo ' <span class="span">Click for Editing</span> <div  class="w3-container w3-white">';
      echo' <p><b ><span >'.$myrow["GovernName"]." ".$myrow["CityName"].'</span></b></p> ';
      echo '<p ><span>'.$myrow["price"].'L.E<br/>'.$myrow["apartdescription"].'</span></p></div></div></a>';
     $index++;
      echo"</a>";
    }


  

  ?>
 

  <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
        <?php
        $index=1;
        $total =$total_pages;
        if($pageno>1){
echo '<a href="?pageno='.intval($pageno-1).'" class="w3-bar-item w3-button w3-hover-black">«</a>';
        }
        else{
            echo '<a href="?pageno=1" class="w3-bar-item w3-button w3-hover-black">«</a>';
        }
        echo '<a href="?pageno=1" class="w3-bar-item w3-black w3-button">1</a>';
        while($total>1){
            echo '<a href="?pageno='.intval($index).'" class="w3-bar-item w3-button w3-hover-black">«</a>';
            $total--;
            $index++;
        }
        if($pageno>1){
            echo '<a href="?pageno='.intval($pageno+1).'" class="w3-bar-item w3-button w3-hover-black">»</a>';
                    }
                    else{
                        echo '<a href="?pageno=1" class="w3-bar-item w3-button w3-hover-black">»</a>';
                    }
        ?>
    </div>
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
<script src="../scripts/editapart.js"></script>


</body>
</html>
