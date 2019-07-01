<?php
include 'connect.php';
include 'header.php';

echo '<br>';

/* Get information about all the categories */

$sql = 'SELECT CategoryID, Name, Description FROM tblcategory';
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
	while($record = $result->fetch_assoc()) {
		echo '<div id="sectionHeader"><h3><a href="category.php?id='
		. $record['CategoryID'] . '">' . $record['Name'] .
		'</h3></a><p>' . $record['Description'] . '</p></div>';
    }
} else {
	echo '<p class="error">No Categories!</p>';
}


if(isset($_SESSION['privilege']) && $_SESSION['privilege'] > 0) {
	?>
	<button onclick="location.href='newcategory.php'">Add Category</button>
	<?php
}


include 'footer.php';
include 'disconnect.php';
?>