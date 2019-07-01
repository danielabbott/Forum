<?php
include "connect.php";
include "header.php";

/* Get information about user */

$sql = "SELECT
            Name,
            JoinDateTime,
            LastLogInDateTime,
            AboutMe,
            IsDeactivated,
            ProfilePicture,
            PrivilegeLevel
        FROM
            tbluser
        WHERE
            UserID = " . mysqli_real_escape_string($conn, $_GET['id']);

$result = $conn->query($sql);

if(!$result || $result->num_rows == 0) {
	echo '<p class="error">Error: User does not exist</p>';
} else {
	$record = $result->fetch_assoc();

	/* Display information */

	?>

	<h3><?php

	if($record['IsDeactivated'] != 0) {
		echo '<strike>';
	}

	echo $record['Name'];

	if($record['IsDeactivated'] != 0) {
		echo '</strike>';
	}

	?>
	</h3>
	<?php

    if($record['PrivilegeLevel'] > 0) {
        echo '<p class="error">Admin</p>';
    }

    if($record['ProfilePicture'] != null) {
        echo '<img src="profpics/' . $record['ProfilePicture'] . '" width="100" /><br/>';

        /* Button for copying user's profile picture */
        if(isset($_SESSION['userid']) && $_GET['id'] != $_SESSION['userid']) {
            echo '<button onclick="location.href=\'setprofilepicture.php?id=' . $record['ProfilePicture'] . '\'" type="button">Take picture</button>';
        }
    }

	if(isset($_SESSION['userid']) && $_GET['id'] == $_SESSION['userid']) {
		/* Provide a button for changing details on the users' profile */
		echo '<button onclick="location.href=\'editprofile.php\'" type="button">Edit profile</button>';
	}

	?>

	<p>Joined <?php  echo $record['JoinDateTime']; ?></p>
    <p>Last logged in <?php  echo $record['LastLogInDateTime']; ?></p>

	<?php if(strlen($record['AboutMe']) != 0) { ?>

		<h3>About Me</h3>
		<p><?php echo $record['AboutMe']; ?></p>

	<?php } ?>


	<?php

}

include "footer.php";
include 'disconnect.php';
?>
