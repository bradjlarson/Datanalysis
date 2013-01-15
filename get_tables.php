<?php
include("db_connect.php");
$database = $_GET["database"];
//$database="test";
mysql_select_db("$database");
$sql = "show tables";
$result = mysql_query($sql);
echo '<select name="table" id="table_select" onchange="get_columns(this.value)">' . PHP_EOL;
echo '<option value="DNS Table">Now, select a table</option>' . PHP_EOL;
while($row = mysql_fetch_array($result))
{
$table = $row[0];
echo '<option value="' . $table . '">' . $table . "</option>" . PHP_EOL;
}
echo '</select>' . PHP_EOL;
?>
