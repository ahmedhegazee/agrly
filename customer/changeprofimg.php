<?php
session_start();
global $uid;
if($_SESSION["uid"]==null)
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
else
$uid =$_SESSION["uid"];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $file = $_FILES['myfile']['name'];
    if(isset($file)){
        $target_dir=dirname(__DIR__,1)."/profileimg/";
        $temp_name = $_FILES['myfile']['tmp_name'];
        if(is_uploaded_file($temp_name)){
              $storedFileName=$target_dir."prof".$uid.".jpg";
              echo $storedFileName;
            if (file_exists($storedFileName)) 
            {
                chmod(dirname(__DIR__,1)."/profileimg",0755);
                chmod($storedFileName,0755);//changes the file permission to write / execute
                unlink($storedFileName);
                }
                    move_uploaded_file($temp_name,$storedFileName);
                    chmod($storedFileName,0744);//changes the file permission to readonly
    }
    }
	
   
        
    echo "<script>alert('Your Profile Image is changed.');</script>\n";
    header( "refresh:0.2;url=http://localhost:8080/agrly/customer/profile.php");
    echo"<script>location.reload();</script>";
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

<title>Change Information | Agerly</title>
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
        margin-top: 5%;
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

<form  name="form" action="changeprofimg.php" enctype="multipart/form-data" method="post">
<div class="content" style="color:#000">
   <div>
       <?php
       
       $file= dirname(__DIR__)."/profileimg/prof".$uid.".jpg";
       $progimg="../profileimg/prof".$uid.".jpg";
       if(file_exists($file))
       echo '<img  id="pimg" src="'.$progimg.'" style="width:45%;" class="w3-round">';
       else
       echo '<img  id="pimg" src="../img/Ahmed.png" style="width:45%;" class="w3-round">';
       
       ?>
   </div>
    
             <div><label>Profile Image</label>
    <input type="file" name="myfile" id="file" Class="file"  accept=".jpg"  placeholder="Your picture"/>
    </div>
     <Button type="submit" Class="btn" type="submit"  >Change Image </Button>
    
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
