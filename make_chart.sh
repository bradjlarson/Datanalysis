#!/bin/ksh
sql_text=$(awk -F': ' 'NR==10 {print $2}' profile.txt)
if [[ -z $sql_text ]]; then
	database=$(awk -F': ' 'NR==1 {print $2}' profile.txt)
	table=$(awk -F': ' 'NR==2 {print $2}' profile.txt)
	xaxis=$(awk -F': ' 'NR==3 {print $2}' profile.txt)
	yaxis=$(awk -F': ' 'NR==4 {print $2}' profile.txt)
	yaxisfunction=$(awk -F': ' 'NR==5 {print $2}' profile.txt)
	yaxisunit=$(awk -F': ' 'NR==6 {print $2}' profile.txt)
	title=$(awk -F': ' 'NR==7 {print $2}' profile.txt)
	charttype=$(awk -F': ' 'NR==8 {print $2}' profile.txt)
	report=$(awk -F': ' 'NR==9 {print $2}' profile.txt)
	sql_text=$(awk -F': ' 'NR==10 {print $2}' profile.txt)
	title2=$(echo $title | sed -e 's/ /_/g')
	title=$title2
	report2=$(echo $report | sed -e 's/ /_/g')
	report=$report2

	cd charts
	mkdir -p $report
	cd $report

	touch $title.php

	echo '<?php' > $title.php
	echo '//$title' >> ./$title.php
	echo 'include("../../lib/pChart/class/pDraw.class.php");' >> ./$title.php
	echo 'include("../../lib/pChart/class/pImage.class.php");' >> ./$title.php
	echo 'include("../../lib/pChart/class/pData.class.php");' >> ./$title.php
	echo 'include("../../db_connect.php");' >> ./$title.php
	echo '$myData = new pData();' >> ./$title.php
	echo 'mysql_select_db("'$database'");' >> ./$title.php
	echo '$sql = "SELECT '$xaxis', '$yaxisfunction'('$yaxis') as y_axis from '$table' group by '$xaxis'";' >> ./$title.php
	echo '$Result  = mysql_query($sql);' >> ./$title.php
	echo '$'$xaxis='""; $'$yaxis'="";' >> ./$title.php
	echo 'while($row = mysql_fetch_array($Result))' >> ./$title.php
	echo '{' >> ./$title.php
	echo '$'$xaxis'[] = $row["'$xaxis'"];' >> ./$title.php
	echo '$'$yaxis'[] = $row["y_axis"];' >> ./$title.php
	echo '}' >> ./$title.php
	echo '$myData->addPoints($'$xaxis',"'$xaxis'");' >> ./$title.php
	echo '$myData->addPoints($'$yaxis',"'$yaxis'");' >> ./$title.php
	echo '$myData->setAbscissa("'$xaxis'");' >> ./$title.php
	echo '$myData->setSerieOnAxis("'$yaxis'", 0);' >> ./$title.php
	echo '$myData->setAxisUnit(0,"$");' >> ./$title.php
	echo '$myData->setXAxisName("'$xaxis'");' >> ./$title.php
	echo '$myPicture = new pImage(700,230,$myData);' >> ./$title.php
	echo '$myPicture->setGraphArea(60,40,670,190);' >> ./$title.php
	echo '$myPicture->setFontProperties(array("FontName"=>"../../lib/pChart/fonts/verdana.ttf","FontSize"=>6));' >> ./$title.php
	#echo '$myPicture->drawText(250,55,"'$title'",array("FontSize"=>12,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));' >> ./$title.php
	echo '$myPicture->drawScale();' >> ./$title.php
	echo '$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>60));' >> ./$title.php
	echo '$myPicture->autoOutput("'$title'.png");' >> ./$title.php
	echo '?>' >> ./$title.php

else

	database=$(awk -F': ' 'NR==6 {print $2}' profile.txt)
	table=$(awk -F': ' 'NR==7 {print $2}' profile.txt)
	xaxis=$(awk -F': ' 'NR==8 {print $2}' profile.txt)
	yaxis=$(awk -F': ' 'NR==9 {print $2}' profile.txt)
	yaxisfunction=$(awk -F': ' 'NR==10 {print $2}' profile.txt)
	yaxisunit=$(awk -F': ' 'NR==2 {print $2}' profile.txt)
	title=$(awk -F': ' 'NR==3 {print $2}' profile.txt)
	charttype=$(awk -F': ' 'NR==4 {print $2}' profile.txt)
	report=$(awk -F': ' 'NR==5 {print $2}' profile.txt)
	sql_text=$(awk -F': ' 'NR==1 {print $2}' profile.txt)
	title2=$(echo $title | sed -e 's/ /_/g')
	title=$title2
	report2=$(echo $report | sed -e 's/ /_/g')
	report=$report2

	cd charts
	mkdir -p $report
	cd $report

	touch $title.php

	echo '<?php' > $title.php
	echo '//$title' >> ./$title.php
	echo 'include("../../lib/pChart/class/pDraw.class.php");' >> ./$title.php
	echo 'include("../../lib/pChart/class/pImage.class.php");' >> ./$title.php
	echo 'include("../../lib/pChart/class/pData.class.php");' >> ./$title.php
	echo 'include("../../db_connect.php");' >> ./$title.php
	echo '$myData = new pData();' >> ./$title.php
	#echo 'mysql_select_db("'$database'");' >> ./$title.php
	echo '$sql="'$sql_text '";' >> ./$title.php
	echo '$Result  = mysql_query($sql);' >> ./$title.php
	echo '$xaxis=""; $yaxis="";' >> ./$title.php
	echo 'while($row = mysql_fetch_array($Result))' >> ./$title.php
	echo '{' >> ./$title.php
	echo '$xaxis[] = $row[0];' >> ./$title.php
	echo '$yaxis[] = $row[1];' >> ./$title.php
	echo '}' >> ./$title.php
	echo '$myData->addPoints($xaxis,"X-axis");' >> ./$title.php
	echo '$myData->addPoints($yaxis,"Y-axis");' >> ./$title.php
	echo '$myData->setAbscissa("X-axis");' >> ./$title.php
	echo '$myData->setSerieOnAxis("Y-axis", 0);' >> ./$title.php
	echo '$myData->setAxisUnit(0,"$");' >> ./$title.php
	echo '$myData->setXAxisName("X-axis");' >> ./$title.php
	echo '$myPicture = new pImage(700,230,$myData);' >> ./$title.php
	echo '$myPicture->setGraphArea(60,40,670,190);' >> ./$title.php
	echo '$myPicture->setFontProperties(array("FontName"=>"../../lib/pChart/fonts/verdana.ttf","FontSize"=>6));' >> ./$title.php
	#echo '$myPicture->drawText(250,55,"'$title'",array("FontSize"=>12,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));' >> ./$title.php
	echo '$myPicture->drawScale();' >> ./$title.php
	echo '$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>60));' >> ./$title.php
	echo '$myPicture->autoOutput("'$title'.png");' >> ./$title.php
	echo '?>' >> ./$title.php
fi
exit
