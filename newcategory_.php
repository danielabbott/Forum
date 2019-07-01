<?php
include 'connect.php';
include 'header.php';

/* Insert new record for the category into the MySQL database */

$sql = 'INSERT INTO tblcategory '.
       '(Name,Description) '.
       'VALUES '.
       '("' . mysqli_real_escape_string($conn, $_POST['name']) . '","' . mysqli_real_escape_string($conn, $_POST['desc']) . '")';

if(!$conn->query($sql))
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
else {
	echo '<p>Category created.</p>';
}

include 'footer.php';
include 'disconnect.php';
?>