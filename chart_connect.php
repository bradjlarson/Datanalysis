<?php
include("db_connect.php");
include("sql_sync.php");
mysql_select_db("reports");
/*
// Create table


$sql = "CREATE TABLE House2
(rowID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(rowID),
Name varchar(15),
Type varchar(15),
Item char(100)
)";

// Execute query
mysql_query($sql,$con);
*/

// Insert values
if (!isset($_POST['sql_text']))
{
	$sql="INSERT INTO profiles (database_name, tables_name, x_axis_column, x_axis_name, y_axis_column, y_axis_name, y_axis_function, y_axis_units, chart_title, current_report, intended_report, sql_text)
	VALUES
	('$_POST[database]','$_POST[table]','$_POST[xaxis]','$_POST[xaxis]','$_POST[yaxis]','$_POST[yaxis]','$_POST[yaxis_function]','$_POST[yaxis_units]','$_POST[title]','$_POST[chart_type]','temp','$_POST[parent_report]', null)";	
}
else 
{
	$sql="INSERT INTO profiles (database_name, tables_name, x_axis_column, x_axis_name, y_axis_column, y_axis_name, y_axis_function, y_axis_units, chart_title, chart_type, current_report, intended_report, sql_text)
	VALUES
	('$_POST[database]','$_POST[table]','$_POST[xaxis]','$_POST[xaxis]','$_POST[yaxis]','$_POST[yaxis]','$_POST[yaxis_function]','$_POST[yaxis_units]','$_POST[title]','$_POST[chart_type]','temp','$_POST[parent_report]', '$_POST[sql_text]')";
}

if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
$chart_profile = "./profile.txt";
$fh = fopen($chart_profile, 'w') or die("can't open profile.txt");
foreach($_POST as $key=>$value) {
$data_pair = "$key: $value\n";
fwrite($fh, $data_pair);
}
fclose($fh);
$command='./make_chart.sh';
$create_chart = system($command);
$sync_db = sql_sync("profiles");
//$redirectURL = 'http://shopsimply.me/make_chart.php';
//header("Location: ".$redirectURL);
?>
