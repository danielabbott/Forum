<?php
include "connect.php";
include "pepper.php";

$salt = random_int(0, 4294967295);
$encryptedPassword = hash("sha256", $_POST['password'] . $salt . $pepper);

/* Insert record for new user into MySQL database */

$sql = 'INSERT INTO tbluser '.
       '(Name,Password,Salt) '.
       'VALUES '.
       '("' . mysqli_real_escape_string($conn, $_POST['username']) . '", "'. $encryptedPassword .'", '. $salt .')';


if(!$conn->query($sql)) {
	include "header.php";
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
} else {
	/* Log in */

	$_SESSION['userid'] = $conn->insert_id;
	$_SESSION['username'] = $_POST['username'];

	include "header.php";

	echo '<p>Welcome to the forums, ' . $_SESSION['username'] . '</p>';
	
}


include "footer.php";
include 'disconnect.php';
?>