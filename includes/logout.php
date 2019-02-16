<?php

session_start();

$_SESSION['email'] = null;
$_SESSION['password'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['image'] = null;
$_SESSION['username'] = null;
$_SESSION['user_id'] = null;

header("Location:../index.php")
?>