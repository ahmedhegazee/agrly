<?php
session_start();
global $uid;
global $db;
global $desc;
global $govern;
global $city;
global $price;
global $rooms;
global $bathrooms;
global $kitchen;
$db=mysqli_connect("localhost","root","","agrly");
if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
$uid =$_SESSION["uid"];

if(isset($_GET['id']))
{    global $apartid;
    $apartid=$_GET['id'];
    $sql="select apartdescription,city,govern,price,numOfBathrooms,numOfKitchen,numOfRooms,isRented from Apartements where apartid='$apartid'";
    $result = mysqli_query($db,$sql);
while($myrow = mysqli_fetch_array($result)){
     $desc =$myrow["apartdescription"];
 $govern=$myrow["govern"];
 $city=$myrow["city"];
 $price=$myrow["price"];
 $rooms=$myrow["numOfRooms"];
 $bathrooms=$myrow["numOfBathrooms"];
 $kitchen=$myrow["numOfKitchen"];}
}
else{

 header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
   $desc=$_POST["desc"];
   $govern=$_POST["govern"];
   $city=$_POST["city"];
   $price=$_POST["price"];
   $rooms=$_POST["nor"];
   $bathrooms=$_POST["nobr"];
   $kitchen=$_POST["nok"];

    $sql="update  Apartements
    set apartdescription ='$desc',city='$city',govern='$govern',price='$price'
    ,numOfBathrooms='$bathrooms',numOfKitchen='$kitchen',numOfRooms='$rooms' 
    where userid='$uid' and apartid='$apartid';";
    $result = mysqli_query($db,$sql);
    $file = $_FILES['myfile']['name'];
    if(isset($file)){
        $target_dir=dirname(__DIR__,1)."/apartimg/";
        $temp_name = $_FILES['myfile']['name'];
        if(is_uploaded_file($temp_name)){
            $filename="apart".$aprtid.".jpg";
              $storedFileName=$target_dir.$filename;
              
             require_once("../api/UserOperation.php");
              
            if (file_exists($storedFileName)) 
            {
               
                chmod($storedFileName,0755);//changes the file permission to write / execute
                unlink($storedFileName);
                }
                resizeApartImage($filename,$storedFileName);
                    move_uploaded_file($temp_name,$storedFileName);
                    chmod($storedFileName,0744);//changes the file permission to readonly
        
    }
    }
	
   
        
   echo "<script>alert('Your Apartment is added.');</script>\n";
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

<title>Edit Apartement | Agerly</title>
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
        margin-top: 55%;
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
form div:last-of-type{    height: 135px;}
</style>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
function select(val)
{
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
}

</script>
</head>
<?php
include '../master.php';
?>

<form  name="form" action="EditApart.php" enctype="multipart/form-data" method="post">
<div class="content" style="color:#000">
   
<div><label>Apartement Image</label>
    <input type="file" name="myfile" id="file" Class="file"  accept=".jpg"  placeholder="Your picture"/>
    </div>
    <div><label>Government</label>
              <select name="govern" id="govern" onchange="select(this.value);">
              <option>Select Government</option>
            <?php
             $db=mysqli_connect("localhost","root","","agrly");
             $sql="select * from Govern ";
             $result = mysqli_query($db,$sql);
            while($myrow=mysqli_fetch_array($result)){
                    echo "<option value=".$myrow["GovernID"].">".$myrow["GovernName"]."</option>";
                 }
            ?>
            </select>
    </div>
    <div><label>City</label>
              <select id="city" name="city">
<?php
$sql="select CityName,CityID from City where govern='$govern'";
$result = mysqli_query($db,$sql);
while($row=mysqli_fetch_array($result))
{
 echo "<option value=".$row['CityID'].">".$row["CityName"]."</option>";
}
?>
              </select>
    </div>
        <div><label>Number of Rooms</label>
        <?php
        echo '<input type=number id="nor"   name=nor required placeholder="Number of Rooms" value='.$rooms.' />';
        ?>
    
    </div>
        <div><label>Number of Kitchen</label>
 
            <?php
        echo ' <input ID="nok" type="number" name="nok" required placeholder="Number of Kitchen"  value='.$kitchen.' />';
        ?>
        </div>
        <div><label>Number of Bathrooms</label>
            <?php
        echo ' <input ID="nobr" type="number" name="nobr" required placeholder="Number of Bathrooms" value='.$bathrooms.' />';
        ?>
        </div>
             
    <div><label>price</label>
    <?php
        echo ' <input type=number id="price"   name=price required placeholder="Price" value='.$price.' />';
        ?>   
</div>
    <div><label>Apartement Description</label>
    <textarea placeholder="Apartement Description" name="desc" rows=3 cols=10>
        <?php
        echo $desc;
        ?>
    </textarea>
    </div>
        
     <Button type="submit" Class="btn" type="submit"  >Save Changes </Button>
     <?php
     $id=intval($apartid);
 echo '<a onclick="deleteApart('.$id.')" class=btn style=background-color:#bb0b0b; >Delete Apartement</a>';
?>
</div> 
</form>
      

      
</div>
<div style="clear:both"></div>
        <script>
        function deleteApart(apartid){
            if(confirm("Do you wnat to delete this apartment")){
                location.replace("http://localhost:8080/agrly/customer/DeleteApart.php?id="+apartid);
            }
        }
        </script>
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
<?php
echo"<script>
window.onload=function(){
    var govern=document.getElementById('govern'),
city=document.getElementById('city');
govern.selectedIndex='$govern';
}

</script>";
?>

</body>
</html>
