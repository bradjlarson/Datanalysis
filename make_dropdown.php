<?php
include("db_connect.php");
if ($_GET['item_id'] == "options_reports")
{
	mysql_select_db("reports");
	$sql = "SELECT distinct report_name from reports.reports";
	$result = mysql_query($sql);
 	echo '<select id="' . $_GET['item_id'] . '" onchange="update_content(this.id, this.value)">' . PHP_EOL;
	echo '<option value="DNS Report">Please select a report</option>' . PHP_EOL;
	while($row = mysql_fetch_array($result))
	{
		echo '<option value="' . $row['report_name'] . '">' . $row['report_name'] . '</option>' . PHP_EOL;
	}
	echo '</select>' . PHP_EOL;
}
else
{
	echo '<select id="' . $_GET['item_id'] . '" onchange="update_content(this.id, this.value)">' . PHP_EOL;
	echo '<option value="Oops?">Oops?</option>' . PHP_EOL;
	echo '<option value="Oops?">' . $_GET["item_id"] . '</option>' . PHP_EOL;
	echo '</select>' . PHP_EOL;
} 
?>
