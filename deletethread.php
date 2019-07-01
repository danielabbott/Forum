<?php
include "connect.php";
include "header.php";

$sql = 'DELETE FROM tblpost WHERE ThreadId = ' . $_POST['ThreadID'];
$conn->query($sql);

$sql = 'DELETE FROM tblthread WHERE ThreadId = ' . $_POST['ThreadID'];
$conn->query($sql);

?>

<p>Thread deleted.</p>

<?php

include "footer.php";
include 'disconnect.php';
?>
