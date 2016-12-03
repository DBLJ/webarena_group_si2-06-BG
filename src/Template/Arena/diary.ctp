<div id="insideEvents">
<?php
if ($Events) {
	# code...
for ($i=0; $i < count($Events) ; $i++) {
		/*$date = $Events[$i]['date'];
		$dateTest = date_create_from_format('d-m-Y', '11/7/14, 12:00 PM');
		$dateNow = $actualdate;
    		echo '<p>';
    		//echo $date;
    		echo date_format($dateTest, 'Y-m-d H:i:s');
    		echo $Events[$i];
    		echo '</p>';
    	}*/
    	$format = 'Y-m-d H:i:s';
    	$date = $Events[$i]['date'];
    	$date2 = $date->format($format);
    	$date3=date_create_from_format($format, $date2);
    	$dateAfter=date_create_from_format($format, $actualdate);
    	$interval = date_diff($date3,$dateAfter);
		//$date2 = DateTime::createFromFormat($format, '$date');
		$dateFinal= $interval->format('%a');
		if ($dateFinal <= 1 ) {
			echo '<p>';
			echo $Events[$i]['date'];
			echo ':  ';
    		echo $Events[$i]['name'];
    		echo '</p>';
		}
}}
?>
</div>