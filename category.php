<?php
include "connect.php";
include "header.php";

/* Get category name, description, etc. */

$sql = "SELECT
            Name,
            Description
        FROM
            tblcategory
        WHERE
            CategoryID = " . mysqli_real_escape_string($conn, $_GET['id']);

$result = $conn->query($sql);

if(!$result || $result->num_rows == 0) {
	echo '<p class="error">Error: Category does not exist</p>';
} else {
	$record = $result->fetch_assoc();

	echo '<div id="sectionHeader">';

	echo '<h3>' . $record['Name'] . '</h3><p>' . $record['Description'] . '</p>';

	echo '<button onclick="location.href=\'newthread.php?categoryid=' . $_GET['id'] . '\'" type="button">Start Thread</button></div>';

	/* Get all threads in this category */

	$sql = "SELECT
			ThreadID,
			CreatorUserID,
			PostCount,
			ThreadTitle
		FROM
			tblthread
		WHERE
			CategoryID = " . mysqli_real_escape_string($conn, $_GET['id']);

	$result = $conn->query($sql);

	if(!$result || $result->num_rows == 0) {
		echo '<p class="error">No threads to display</p>';
	} else {
		while($record = $result->fetch_assoc()) {
			echo '<div id="sectionHeader">';
			echo '<a href="thread.php?id=' . $record['ThreadID'] . '">';
			echo '<h3>' . $record['ThreadTitle'] . '</h3></a>';

			/* Get Original Poster's name */

			$sql = "SELECT
				Name
			FROM
				tbluser
			WHERE
				UserID = " . $record['CreatorUserID'];

			$result2 = $conn->query($sql);

			$op = '';
			if($result2) {
				$op = $result2->fetch_assoc()['Name'];
			}

			echo '<p>Posted by ' . $op . '. Total Posts: ' . $record['PostCount'] . '</p>';

            if(isset($_SESSION['privilege']) && $_SESSION['privilege'] > 0) {
                ?>

                <form action= "deletethread.php" method="post">
    			<input type="hidden" name="ThreadID" value=<?php echo '"' . $record['ThreadID'] . '"'; ?> />
    			<input type="submit" value="Delete">
                </form>

                <?php
            }

			echo '</div>';
		}
	}
}
include "footer.php";
include 'disconnect.php';
?>
