<?php
session_start();
session_destroy();
session_abort();
$_SESSION["uid"]==null;
header( "refresh:0.2;url=http://localhost:8080/agrly/Home.html");
?>