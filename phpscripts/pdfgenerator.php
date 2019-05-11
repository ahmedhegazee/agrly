<?php
require dirname(__DIR__).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
session_start();
//$items = ;
$cartitems = $_SESSION['cart'];
$html=" ";
if(count($items)==0){
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
         
        $html.='<div >';
        $html.='<img src="'."../apartimg/apart".$myrow["apartid"].'.jpg"   style="width:200px;height:200px;"      />';
        $html.=' <p><b ><span >'.$myrow["firstname"]." ".$myrow["lastname"].'</span></b></p> ';
        $html.=' <p><b ><span >'.$myrow["GovernName"]." ".$myrow["CityName"].'</span></b></p> ';
        $html.= '<p ><span>'.$myrow["usertel"].'</span></p>';
        $html.= '<p ><span>'.$myrow["price"].'L.E<br/>'.$myrow["apartdescription"].'</span></p></div>';

    }  
$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($html);
$html2pdf->output();
}
?>