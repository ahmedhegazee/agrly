<?php
session_start();
if(isset($_POST["apartid"])){
    $apartid=intval($_POST["apartid"]);
if(isset($_SESSION['cart']) ){
	$items = $_SESSION['cart'];
	$cartitems = explode(",", $items);
	$items .= "," . $apartid;
	$_SESSION['cart'] = $items;
}else{
	
	$_SESSION['cart'] = $apartid;

}
echo 1;
}
else
echo 0;
?>