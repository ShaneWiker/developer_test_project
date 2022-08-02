<?php
include('conn.php');
$bid = $_GET['id'];
$uid = $_GET['uid'];
$sql = "DELETE FROM budgets WHERE id='".$bid."'";
$conn->query($sql);
header("Location: user-detail.php?id=".$uid);
exit();
?>