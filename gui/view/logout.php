<?php
$token = $_SESSION["token"];
$query = $conn->prepare("UPDATE users SET token = Null WHERE token='$token'");
$query->execute();
$_COOKIE["token"] = "";
session_unset();
header('Location: index.php?id=1');
exit(); 
?>
