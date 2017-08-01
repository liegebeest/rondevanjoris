<?php 
	require 'db.php';
 	$sqltran = mysqli_query($con, "SELECT link, name, source FROM stukjes") or die(mysqli_error($con));
	$arrVal = array();
 	$i=1;
 	while ($rowList = mysqli_fetch_array($sqltran)) {
 							 
		$column = array(
		    'link'=> $rowList['link'],
			'name'=> $rowList['name'],
			'source'=> $rowList['source']
    		);		
		array_push($arrVal, $column);	
		$i++;			
 	}
 	echo  json_encode($arrVal);		
 	mysqli_close($con);
?>   
 
