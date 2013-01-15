<?php
include("db_connect.php");

function sql_sync($dependency)
{
mysql_select_db("reports");
$sql = 'SELECT * from reports.objects where dependent_on ="'.$dependency.'"';
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
{
	$sql = $row['object_content'];
	$execute = mysql_query($sql);
}
}

?>