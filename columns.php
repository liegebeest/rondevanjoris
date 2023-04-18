<?php 
// dskjflsakdjfkldsjflksdaj
	require 'db.php';
 	$sqltran = mysqli_query($con, "SELECT link, source, date, genre FROM stukjes ORDER BY date DESC") or die(mysqli_error($con));
	$arrVal = array();
 	$i=1;
 	while ($rowList = mysqli_fetch_array($sqltran)) {
 							 
		$column = array(
		    'link'=> $rowList['link'],
			'source'=> $rowList['source'],
			'date' => $rowList['date'],
			'genre' => $rowList['genre']
    		);		
		array_push($arrVal, $column);	
		$i++;			
 	}
 	echo  json_encode($arrVal);		
 	mysqli_close($con);
?>   
 
