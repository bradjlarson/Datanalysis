<html>
<head>
<link rel="stylesheet" type="text/css" href="css/da_main.css">
<!-- Once Javascript is perfected, it will be listed here:
	<script type="text/javascript" src="js/get_columns.js"></script>
	<script type="text/javascript" src="js/get_tables.js"></script>
	<script type="text/javascript" src="js/get_chart.js"></script>
-->
	<script src="lib/jquery-1.8.3.min.js"></script>
	<script src="lib/jquery.autosize.js"></script>
</head>
<body>
<div id="site">
<div id="top">
<div id="logo" onclick='window.location = "datanalysis.php"'>
<p id="logo_text">DATANALYSIS</p>
</div>
<div id="login">
<p><a onclick='alert("Coming soon")'>Login</a> / <a onclick='alert("Coming soon")'>Acct Mgmt</a></p>
</div>
</div>
<div id="main">
<div id="options">
	<br />
	<a id="options_reports_container" name='Reports'>
		<p id="options_reports" onclick="make_dropdown(this.id)">Report</p>
	</a>
	<a id="options_charts" onclick="make_dropdown(this.id)">
		<p>Charts</p>
	</a>
	<a id="options_settings" onclick="get_DOM()">
		<p>Settings</p>
	</a>
	<a id="options_history" onclick='alert("Coming soon")'>
		<p>History</p>
	</a>
</div>
<div id="content">
<div id="form">
<div id="form_options">
<div id="form_opt1" onclick='fill_form("1"); return false;'>
<p>Basic</p>
</div>
<div id="form_opt2" onclick="fill_form(2); return false;">
<p>Advanced</p>
</div>
</div>
<div id="form_body">
<p>First, select an option above.</p>
</div>
</div>
<div id="preview">
<div id="preview_title_h">
<p>Preview:</p>
</div>
<div id="preview_body">
<br />
<br />
<br />
<p>Second, complete the form to the left.</p>
</div>
<div id="preview_submit">
</div>
</div>
</div>
</div>
</body>
<script type="text/javascript">
function make_dropdown(item_id) {
	$("#"+item_id+"_container").load('make_dropdown.php?item_id=' + item_id);
}
</script>
<script type="text/javascript">
function update_content(item_id, item_value) {
	$("#"+item_id+"_container").html('<p id="options_reports" onclick="make_dropdown(this.id)">Reports</p>');
	$("#content").load('update_content.php',{item_id : item_id, item_value : item_value});

}
</script>
<script type="text/javascript">
function make_textarea(title_id) {
	var tag_open = '<textarea id="' + title_id + '" onchange="report_update(this.id, this.value)">';
	var tag_body = $("#" + title_id).html();
	var tag_close = '</textarea>';
	$("#"+title_id+"_h").html(tag_open + tag_body + tag_close);
}
</script>
<script type="text/javascript">
function report_update(text_id, text_value) {
	$i = 1;
	if ( $i == 1)
	{
		alert("Text_id: " + text_id + ", Text_value: " + text_value);
		var replacement = '<p id="'+text_id+'" onclick="make_textarea(this.id)">'+text_value+'</p>';
		$("#"+text_id+"_h").html(replacement);
	}
	else
	{
	var title_update = {title_id: text_id, title_value: text_value};
	$.ajax(
		{
			type: "POST",
			data: title_update,
			url: "title_update.php",
		})
}
}
</script>
<script type="text/javascript">
function fill_form(option)
{
	if (option== 1)
	{
		$('#form_body').load('make_chart_b.php');
		return false;
	}
	else
	{
		$('#form_body').load('make_chart_a.php');
		return false;
	}
}
</script>
<script type="text/javascript">
function get_tables(database)
{
	$('#table').load('get_tables.php?database=' + database);
}
</script>
<script type="text/javascript">
function get_columns(table)
{
	var db = document.getElementById("database");
	var database = db.options[db.selectedIndex].value;
	var url = 'get_columns.php?database='+database+'&table='+table;
	$('#columns').load(url);
}
</script>
<script type="text/javascript">
function get_chart() {
	var profile = $("#chartprofile").serialize();
	var title = $("#title").val();
	var report = $("#report").val();
	var title_name = '<p id="preview_title" onclick="make_textarea(this.id)">' + title + '</p>';
	title=title.replace(/ /g,"_");
	report=report.replace(" ", "_");
	var preview_alert = title + "added to" + report;
	var preview_fill = '<button id="chart_submit" onclick="add_chart()"><p>Submit</p></button>';
	console.log(title);
	console.log(report);
	
	if (title != "DNS_Table")
	{
	var title_chart = '<img src="charts/' + report + '/' + title + '.php">';
	}
	else
	{
	var title_chart ='<p>Please fill out the form correctly...</p>';
	}
	$.ajax(
		{
			type: "POST",
			data: profile,
			url: "chart_connect.php",
			success: function() {
				$('#preview_body').html(title_chart);
				$('#preview_title_h').html(title_name);
				$('#preview_submit').html(preview_fill);
			}
		});
	return false;
};
</script>
<script type="text/javascript">
function add_chart() {
	var chart_title = $("#preview_title").html();
	var chart_name = $("#title").val();
	var report_name = $("#report").val();
	
	
	alert(title + " added to " + report);
}
</script>
<script type="text/javascript">
	function get_DOM() {		
		function find_children(element,iteration) { 
			for (var i=1, max=element.childNodes.length; i < max; i++) {
				var j = iteration + "." + i;
				console.log(element.childNodes[i].tagName + '/' + element.childNodes[i].id + '/' + j);
				if (element.childNodes[i].childNodes.length > 0)
				{
				find_children(element.childNodes[i],j);
				}
			}
			return;	
		}
		find_children(document.body,1);
	}
</script>
</html>
