<?php
include "connect.php";
include "header.php";

?>

<br>

<form method="post" enctype="multipart/form-data" action= "uploadprofilepicture_.php">
    <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
    <tr>
    <td width="246">
        <input name="imagefile" type="file" id="userfile">
    </td>
        <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
    </tr>
    </table>
</form>

<br>

Maximum file size 1MiB.

<?php

include "footer.php";
include 'disconnect.php';
?>
