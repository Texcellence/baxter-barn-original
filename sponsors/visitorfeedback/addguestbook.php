<?php
$host="localhost"; // Host name 
$username="baxterba_gb"; // Mysql username 
$password="Conservation55?"; // Mysql password 
$db_name="baxterba_guestbook"; // Database name 
$tbl_name="guestbook"; // Table name

$name = ($_POST[name]);

$comment = ($_POST[comment]); 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect server "); 
mysql_select_db("$db_name")or die("cannot select DB");

$datetime=date("y-m-d h:i:s"); //date time

$sql="INSERT INTO $tbl_name(name, comment, datetime)VALUES('$name', '$comment', '$datetime')";
$result=mysql_query($sql);

//check if query successful 
if($result){
echo "Successful";
echo "<BR>";
echo "<a href='display.html.php'>View guestbook</a>"; // link to view guestbook page 
}

else {
echo "ERROR";
}

mysql_close();
?>
<p class="style1">&nbsp;</p>
