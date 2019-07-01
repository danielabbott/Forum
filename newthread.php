<?php
include 'connect.php';
include 'header.php';

if(isset($_SESSION['username'])) { /* User is logged in */
?>
<?php
		if(isset($_GET['categoryid']))
			$categoryID = $_GET['categoryid'];
		else
			$categoryID = 0;

		/* Display a form for entering a thread title and initial post */

?>
		<form action= "newthread_.php" method="post">
			<p style="display:inline;">Thread Title:</p>
			<input type="text" name="title"><br/>
			<textarea name="posttext" rows="25" cols="80"></textarea><br/>
			<input type="hidden" name="categoryid" value=<?php echo '"' . $categoryID . '"'; ?> />
			<input type="submit" value="Start Thread">
		</form>

<?php
} else {
	echo '<p style="color:red;">Only members may create threads.</p>';
}

?>

<br/>

<?php
include 'footer.php';
include 'disconnect.php';
?>