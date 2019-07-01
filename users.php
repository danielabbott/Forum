<?php
include "connect.php";
include "header.php";

/* Get all users' username and ID from database */

$sql = "SELECT UserID, Name, IsDeactivated FROM tbluser";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

	/* Create a table */
	?>

	<br/>

	<table>
		<tr>
			<th> User ID </th><th> Name </th><th> Profile </th>
		</tr>

	<?php

	/* For each user, create a row in the table */

    while($record = $result->fetch_assoc()) {
		echo '<tr>';
			echo '<td>'. $record["UserID"] . '</td>';

			if($record['IsDeactivated'] == 0) {
				echo '<td>' . $record["Name"] . '</td>';
			}
			else {
				/* Deactivated account, strikethrough */
				echo '<td><strike>' . $record["Name"] . '</strike></td>';
			}

			echo '<td><a href="profile.php?id=' . $record["UserID"] . '">Profile</a></td>';
		echo '</tr>';
    }
	echo '</table>';
} else {
    echo "0 results";
}

include "footer.php";
include 'disconnect.php';
?>