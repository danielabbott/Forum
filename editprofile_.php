<?php
include "connect.php";
include "header.php";

/* Update the 'about me' text in the database */

$sql = 	'UPDATE tbluser ' .
		'SET AboutMe="' . mysqli_real_escape_string($conn, $_POST['aboutme']) . '"' .
		'WHERE userid=' . $_SESSION['userid'];

if(!$conn->query($sql)) {
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
} else {
	echo '<p>Profile updated.</p>';
}

include "footer.php";
include 'disconnect.php';
?>