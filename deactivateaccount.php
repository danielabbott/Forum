<?php
include "connect.php";

$loggedIn = isset($_SESSION['userid']);

if($loggedIn) {
	/* Change the 'IsDeactivated' boolean in the database */

	$sql = 	'UPDATE tbluser ' .
		'SET IsDeactivated=1 ' .
		'WHERE userid=' . $_SESSION['userid'];

	$conn->query($sql);

	unset($_SESSION['userid']);
	unset($_SESSION['username']);
}

include "header.php";

if($loggedIn) {
	echo '<p>Your account has been deactivated. Log in to reactivate.</p>';
} else {	
	echo '<p>You must be logged in to deactivate your account.</p>';
}

include "footer.php";
include 'disconnect.php';
?>