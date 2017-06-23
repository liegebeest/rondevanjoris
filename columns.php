<?php 
	require 'db.php';
 		
 		$sqltran = mysqli_query($con, "SELECT link, date, source, name FROM stukjes") or die(mysqli_error($con));
		$arrVal = array();
 		$i=1;
 		while ($rowList = mysqli_fetch_array($sqltran)) {
 								 
						$name = array(
 	 		 	 				'link'=> $rowList['link'],
	 		 	 				'date'=> $rowList['date'],
								'source'=> $rowList['source'],
								'name'=> $rowList['name']
 	 		 	 			);		


							array_push($arrVal, $name);	
			$i++;			
	 	}
	 		 echo  json_encode($arrVal);		
 

	 	mysqli_close($con);
?>   
 