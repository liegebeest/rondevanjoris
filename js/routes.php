<?php 
	require 'db.php';
 		
 		$sqltran = mysqli_query($con, "SELECT date, route, price, places, subscribe FROM routes where routes.`date` > now() ORDER BY routes.`date` ASC")or die(mysqli_error($con));
		$arrVal = array();
 		$i=1;
 		while ($rowList = mysqli_fetch_array($sqltran)) {
 								 
						$name = array(
 	 		 	 				'date'=> $rowList['date'],
	 		 	 				'route'=> $rowList['route'],
								'price'=> $rowList['price'],
								'places'=> $rowList['places'],
								'subscribe'=> $rowList['subscribe']
 	 		 	 			);		


							array_push($arrVal, $name);	
			$i++;			
	 	}
	 		 echo  json_encode($arrVal);		
 

	 	mysqli_close($con);
?>   
 