<!DOCTYPE html>
<html>

<head>
    <title>Forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body id='body'>

<div id='header'>
	<a href='index.php' id="ForumName"><h1 style="color:black;">Forums</h1></a>

<div>

	<form action="users.php" style="display:inline;">
		<button>Users</button>
	</form>

<?php

/* Show logout button only if the user is logged in */

if(isset($_SESSION['username'])) {
?>
	<form action="logout.php" style="display:inline;">
		<button>Log Out</button>
	</form>

	<p style="display:inline">You are logged in as <?php
    echo '<a href="profile.php?id=' . $_SESSION['userid'] . '">' . $_SESSION['username'] . '</a>';
    ?></p>
<?php
}
?>

</div>
</div>

<?php

/* If the user is not logged in, provide a form to enter login details */
if(!isset($_SESSION['username'])) {
?>

	<br/>
	<div>
		<form action= "login.php"; method="post" style="display:inline">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" value="Log In">
		</form>

		<button onclick="location.href='newuser.php'" style="display:inline">Sign Up</button>
	</div>

	<?php
}
?>
