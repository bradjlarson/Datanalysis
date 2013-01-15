<?php
include("db_connect.php");
$sql = "show databases";
$result = mysql_query($sql);
echo '<form action="" id="chartprofile" method="post" onsubmit="get_chart();return false;" >' . PHP_EOL;
echo '<select id="database" class="selector" name="database" onchange="get_tables(this.value)">' . PHP_EOL;
echo '<option value="DNS Database">First, select a database</option>' . PHP_EOL;
while($row = mysql_fetch_array($result))
{
	echo '<option value="' . $row['Database'] . '">' . $row['Database'] . "</option>" . PHP_EOL;
}
echo "</select>" . PHP_EOL;
echo '<div id="table">' . PHP_EOL;
echo '<select class="selector" name="table" id="table_select">' . PHP_EOL;
echo '<option value="DNS Database">Then, select a table first</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '</div>' . PHP_EOL;
echo '<div id="columns">' . PHP_EOL;
echo '<select class="selector" name="columns">' . PHP_EOL;
echo '<option value="DNS Table">Finally, select your columns</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '<input type="hidden" name="xaxis" value="DNS Table">' . PHP_EOL;
echo '<input type="hidden" name="yaxis" value="DNS Table">' . PHP_EOL;
echo '<input type="hidden" name="yaxis_units" value="DNS Table">' . PHP_EOL;
echo '<input type="hidden" name="title" value="DNS Table">' . PHP_EOL;
echo '<input type="hidden" name="chart_type" value="DNS Table">' . PHP_EOL;
echo '<input type="hidden" name="parent_report" value="DNS Table">' . PHP_EOL; 
echo '</div>' . PHP_EOL;
echo '</form>' . PHP_EOL;
?>
