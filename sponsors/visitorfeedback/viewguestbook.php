<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td><strong>View Guestbook | <a href="guestbook.php">Sign Guestbook</a> </strong></td>
</tr>
</table>
<br>

<?php

$host="localhost"; // Host name 
$username="baxterba_gb"; // Mysql username 
$password="Conservation55?"; // Mysql password 
$db_name="baxterba_guestbook"; // Database name 
$tbl_name="guestbook"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect server "); 
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);

while($column=mysql_fetch_array($result)){
?>
	<table style="width: 100%">
		<tr>
			<td style="width: 245px">Name:</td>
		<td style="width: 186px">Email:</td>
		<td style="width: 856px">Comment:</td>
		<td style="width: 272px">Date/Time:</td>
	</tr>
	<tr>
<td style="width: 245px"><? echo $column['name']; ?></td>
<td style="width: 186px"><? echo $column['email']; ?></td>
<td><? echo $column['comment']; ?></td>
<td><? echo $column['datetime']; ?></td>
	</tr>
</table>

<?
}
mysql_close(); //close database
?>