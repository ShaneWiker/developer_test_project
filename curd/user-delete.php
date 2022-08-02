<?php
include('conn.php');
$uid = $_GET['id'];
$sql = "DELETE FROM users WHERE id='".$uid."'";
$conn->query($sql);
header("Location: index.php");
exit();
?>