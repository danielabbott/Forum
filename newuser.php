<?php
include "connect.php";
include "header.php";

if(isset($_SESSION['username'])) { /* User is logged in */

	echo '<p class="error">You already have an acount. Log out first if you wish to create another account.</p>';

} else { /* User is not logged in */

	/* Display a form for entering login details */

	?>

	<br/>

	<form action= "newuser_.php" method="post" name="theform">
		<input type="text" name="username" placeholder="Username"><br/>
		<input type="password" name="password" placeholder="Password"><br/>
		<input type="submit" value="Create Account">
	</form>


	<?php
	
}

include "footer.php";
include 'disconnect.php';
?>