<?php
include 'connect.php';
include 'pepper.php';

/* Get information for user with given username */

$sql = 'SELECT Password,Salt,UserID,IsDeactivated,PrivilegeLevel FROM tbluser WHERE Name = "' . mysqli_real_escape_string($conn, strtolower($_POST['username'])) . '"';
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
	$record = $result->fetch_assoc();

	/* Encrypt password with sha256, add salt and pepper, then compare to value in database */
	if($record['Password'] === hash("sha256", $_POST['password'] . $record['Salt']. $pepper)) {
		/* Passwords match; set session variables */
		$_SESSION['username'] = strtolower($_POST['username']);
		$_SESSION['userid'] = $record['UserID'];
		$_SESSION['privilege'] = $record['PrivilegeLevel'];

		include 'header.php';
		echo '<br>You have logged in as ' . $_SESSION['username'] . '</p>';

		if($record['IsDeactivated'] != 0) {
			/* User has logged in, reactivate account */

			$sql = 	'UPDATE tbluser ' .
				'SET IsDeactivated=0, LastLogInDateTime=now() ' .
				'WHERE userid=' . $_SESSION['userid'];

			$conn->query($sql);
		} else {
			$sql = 	'UPDATE tbluser ' .
				'SET LastLogInDateTime=now() ' .
				'WHERE userid=' . $_SESSION['userid'];

			$conn->query($sql);
		}
	} else {
		include 'header.php';
		echo '<p style="color:red;">Incorrect password!</p>';
	}
} else {
	include 'header.php';
	echo '<p style="color:red;">There is no account with that username!</p>';
}

include 'footer.php';
include 'disconnect.php';
?>
