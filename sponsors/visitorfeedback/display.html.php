<html>
<head>
<title>Visitor Feedback</title>
<style type="text/css">
.style1 {
	text-align: center;
}
</style>
</head>
<body>
	
<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td class="style1"><?php

$db_host = 'localhost';

$db_user = 'baxterba_gb';

$db_pwd = 'Conservation55?';



$database = 'baxterba_guestbook';

$table = 'guestbook';



if (!mysql_connect($db_host, $db_user, $db_pwd))

    die("Can't connect to database");



if (!mysql_select_db($database))

    die("Can't select database");



// sending query

$result = mysql_query("SELECT name as 'Name', comment as 'Comment', datetime as 'Date' FROM guestbook");

if (!$result) {

    die("Query to show fields from table failed");

}



$fields_num = mysql_num_fields($result);

echo "<table border='1' width='700'><tr>";

// printing table headers

for($i=0; $i<$fields_num; $i++)

{

    $field = mysql_fetch_field($result);

    echo "<td>{$field->name}</td>";

}

echo "</tr>\n";

// printing table rows

while($row = mysql_fetch_row($result))

{

    echo "<tr>";



    // $row is array... foreach( .. ) puts every element

    // of $row to $cell variable

    foreach($row as $cell)

        echo "<td>$cell</td>";



    echo "</tr>\n";

}

mysql_free_result($result);

?>
</td>
</tr>
</table>

<p class="style1"><br>
</p>
<p>&nbsp;</p>

</body></html>