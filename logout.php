<?php

@include'config.php';
session_start();
session_unset();
session_destroy();

header('location:login.php');
mysqli_query($mysqli,"DELETE FROM `cart`");

?>