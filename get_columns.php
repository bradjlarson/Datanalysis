<?php
include("db_connect.php");
for ($i=1; $i<=2; $i++)
{
$database = $_GET["database"];
$table = $_GET["table"];
mysql_select_db("$database");
$sql = "show columns from $table";
$result = mysql_query($sql);
if ($i==1)
{
echo '<select name="xaxis">' . PHP_EOL;
echo '<option value="DNS X Axis">Now select a X Axis</option>' . PHP_EOL;
}
else
{
echo '<select name="yaxis">' . PHP_EOL;
echo '<option value="DNS Y Axis">And a Y Axis</option>' . PHP_EOL;
}
while($row = mysql_fetch_array($result))
{
$field = $row[0];
echo '<option value="' . $field . '">' . $field . "</option>" . PHP_EOL;
}
echo '</select>' . PHP_EOL;
echo '<br />' . PHP_EOL;
if ($i==2)
{
echo '<select name="yaxis_function">' . PHP_EOL;
echo '<option value="DNS Function">How would you like to group the Y Axis?</option>' . PHP_EOL;
echo '<option value="sum">Sum</option>' . PHP_EOL;
echo '<option value="avg">Average</option>' . PHP_EOL;
echo '<option value="count">Count</option>' . PHP_EOL;
echo '<option value="min">Min</option>' . PHP_EOL;
echo '<option value="max">Max</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '<br />' . PHP_EOL;
echo '<select name="yaxis_units">' . PHP_EOL;
echo '<option value="DNS Unit">Please select the units for the Y Axis</option>' . PHP_EOL;
echo '<option value="Numerical">Numerical</option>' . PHP_EOL;
echo '<option value="Dollars">$</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '<br />' . PHP_EOL;
echo 'Chart Title: <input id="title" type="text" name="title" />' . PHP_EOL;
echo '<br />' . PHP_EOL;
echo '<select name="chart_type">' . PHP_EOL;
echo '<option value="DNS Chart Type">Please select a chart type</option>' . PHP_EOL;
echo '<option value="Bar">Bar Chart</option>' . PHP_EOL;
echo '<option value="Line">Line Chart</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '<br />' . PHP_EOL;
echo '<select id="report" name="parent_report">' . PHP_EOL;
echo '<option value="DNS Report">Please select a report to add this chart to</option>' . PHP_EOL;
echo '<option value="Report1">Report 1</option>' . PHP_EOL;
echo '<option value="Report2">Report 2</option>' . PHP_EOL;
echo '</select>' . PHP_EOL;
echo '<br />' . PHP_EOL;
echo '<input type="Submit" id="submit" value="Submit">' . PHP_EOL;
}
}
?>
