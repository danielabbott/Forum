<?php
include 'connect.php';
include 'header.php';

/* Update text in MySQL database and the IsEdited boolean */

$sql = 	'UPDATE tblpost ' .
    'SET Text="' . $_POST['posttext'] .
    '", IsEdited=1' .
    ' WHERE postid=' . mysqli_real_escape_string($conn, $_POST['postid']);

if(!$conn->query($sql)) {
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
}
else {
	echo '<p>Post updated.</p>';
}

include 'footer.php';
include 'disconnect.php';
?>
