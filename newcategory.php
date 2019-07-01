<?php
include 'connect.php';
include 'header.php';

if(isset($_SESSION['username']) && $_SESSION['privilege'] > 0) { /* User is logged in and is admin */
?>
<?php
		/* Display a form for entering a category title and description */

?>
		<form action = "newcategory_.php" method="post">
			<p style="display:inline;">Category Name:</p>
			<input type="text" name="name"><br/>
			<textarea name="desc" rows="2" cols="80"></textarea><br/>
			<input type="submit" value="Create category">
		</form>

<?php
} else {
	echo '<p style="color:red;">Only admins may create new categories.</p>';
}

?>

<br/>

<?php
include 'footer.php';
include 'disconnect.php';
?>