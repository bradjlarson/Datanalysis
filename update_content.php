<?php
include("db_connect.php");
if ( isset($_POST['item_id']) )
{
$update_request = $_POST['item_id'];
$update_value = $_POST['item_value'];
}
else
{
$update_request = $_GET['item_id'];
$update_value = $_GET['item_value'];
}
if ( $update_request == "options_reports" )
{
	$i = 1;
	echo '<div id="reports">' . PHP_EOL;
	$sql = 'SELECT slide_title, chart_title, chart_url from reports.reports where report_name = "' . $update_value . '" order by id desc limit 10';
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result))
	{
		echo '<div class="slide">' . PHP_EOL;
			echo '<div id="reports_' . $row['slide_title'] . '">' . PHP_EOL;
				echo '<div class="report_content">' . PHP_EOL;
					echo '<div id="' . $update_value . '_slide' . $i . '_h">' . PHP_EOL;
						echo '<p id="' . $update_value . '_slide' . $i . '" onclick="make_textarea(this.id)">' . $row['slide_title'] . '</p>' . PHP_EOL;
					echo '</div>' . PHP_EOL;
					echo '<div class="chart_title">' . PHP_EOL;
						echo '<p>'.$row['chart_title'].'</p>' . PHP_EOL;
					echo '</div>' . PHP_EOL;
					echo '<div class="chart">' . PHP_EOL;
						echo '<img src="' . $row['chart_url']  . '">' . PHP_EOL;
					echo '</div>' . PHP_EOL;
					echo '<div class="report_settings">' . PHP_EOL;
						echo '<div class="slide_number" name="'. $i . '">  ' . $i . '  </div>' . PHP_EOL;
						echo '<div class="slide_settings" name="' . $i . '">  *  </div>' . PHP_EOL;
						echo '<div class="slide_status" name="' . $i . '">  Saved  </div>' . PHP_EOL;
					echo '</div>' . PHP_EOL;
				echo '</div>' . PHP_EOL;
			echo '</div>' . PHP_EOL;		
		echo '</div>' . PHP_EOL;			
		$i = $i + 1; 
	}
} 
else
{
	echo '<p>Oops?</p>' . PHP_EOL;
}
?>