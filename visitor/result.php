
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
</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
window.onload=function ()
{
    var govern=document.getElementById("govern");
 $.ajax({
 type: 'post',
 url: '../phpscripts/fetchGoverns.php',
 
 success: function (response) {
  govern.innerHTML=response; 
 }
 });
};
function select()
{
    var govern=document.getElementById("govern"),
    val=govern.value;
    
 $.ajax({
 type: 'post',
 url: '../phpscripts/fetch_data.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("city").innerHTML=response; 
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
      
  <form action="result.php" method="GET">
            <div>
                <ul>
                    <li><h3>Filter Result</h3></li>
                   <li><select name="govern" id="govern" onchange="select()" placeholder="Govern" required>
                    <option >Select Govern</option>
                    
                </select></li>
                <li> <select id="city" name="city">
                </li>
                <li><input type=number placeholder="Price" name="price" required/> </li>
                <li><button type="submit"><i class="fas fa-search"></i></button></li>
                </ul>
                
            </div>
        </form>
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
    <h1><b>Searched Apartements</b></h1>
    </div>
    <a href="AddApartement.php" class="btn">Wished Apartement</a>
  </header>
  <?php
  global $pageno;
  global $total_pages;
  $no_of_records_per_page = 6;
  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
  $offset = ($pageno-1) * $no_of_records_per_page; 
  global $govern,$price,$city,$db;
    $db=mysqli_connect("localhost","root","","agrly");


if(isset($_GET["govern"])&&isset($_GET["price"])&&isset($_GET["city"])){
$govern=intval($_GET["govern"]);
$price=$_GET["price"];
$city=intval($_GET["city"]);

//displaying specified aprtments
$total_pages_sql = "SELECT COUNT(*) FROM Apartements where govern=$govern and city=$city and price<=$price;";
$result = mysqli_query($db,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];

$total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql1="SELECT apartid,apartdescription,price,u.firstname,u.lastname,g.GovernName,c.CityName 
  FROM ((Apartements a join Users u on a.userid=u.userid)
  join Govern g on a.govern = g.GovernID) join City c on a.city=c.CityID 
  WHERE a.govern=$govern and a.isRented=1 and a.city=$city and a.price<= $price LIMIT $offset, $no_of_records_per_page;";
   $result1 = mysqli_query($db,$sql1);
    $index=1;
    while($myrow = mysqli_fetch_array($result1))
    {
      if($index==6)
        break;
      echo '<a href="Details.php?id='.$myrow["apartid"].'">';
      echo'<div class="w3-third w3-container">';
      echo'<img src="'."../apartimg/apart".$myrow["apartid"].'.jpg"   style="width:100%"  onmouseover="show('.($index-1).');" onmouseout="hide('.($index-1).');"   CssClass="w3-hover-opacity"/>';
      echo ' <span class="span">Click for Details</span> <div  class="w3-container w3-white">';
      echo' <p><b ><span >'.$myrow["firstname"]." ".$myrow["lastname"].'</span></b></p> ';
      echo '<p ><span>'.$myrow["price"].'L.E<br/>'.$myrow["apartdescription"].'</span></p></div></div></a>';
     $index++;
      echo"</a>";
    }

}else{
//displaying all aprtments
    $total_pages_sql = "SELECT COUNT(*) FROM Apartements ;";
$result = mysqli_query($db,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];

$total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql1="SELECT apartid,apartdescription,price,u.firstname,u.lastname,g.GovernName,c.CityName 
  FROM ((Apartements a join Users u on a.userid=u.userid)
  join Govern g on a.govern = g.GovernID) join City c on a.city=c.CityID where a.isRented=1
   LIMIT $offset, $no_of_records_per_page;";
    $result1 = mysqli_query($db,$sql1);
    $index=1;
    
   
    
    while($myrow = mysqli_fetch_array($result1))
    {
      if($index==6)
        break;
      echo '<a href="Details.php?id='.$myrow["apartid"].'">';
      echo'<div class="w3-third w3-container">';
      echo'<img src="'."../apartimg/apart".$myrow["apartid"].'.jpg"   style="width:100%"  onmouseover="show('.($index-1).');" onmouseout="hide('.($index-1).');"   CssClass="w3-hover-opacity"/>';
      echo ' <span class="span">Click for Editing</span> <div  class="w3-container w3-white">';
      echo' <p><b ><span >'.$myrow["firstname"]." ".$myrow["lastname"].'</span></b></p> ';
      echo' <p><b ><span >'.$myrow["GovernName"]." ".$myrow["CityName"].'</span></b></p> ';
      echo '<p ><span>'.$myrow["price"].'L.E<br/>'.$myrow["apartdescription"].'</span></p></div></div></a>';
     $index++;
      echo"</a>";
    }

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
