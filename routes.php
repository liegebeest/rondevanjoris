<?php 

require 'db.php';
$sqltran = mysqli_query($con, "SELECT date, route, price, places, id FROM routes where routes.`date` > now() ORDER BY routes.`date` ASC")or die(mysqli_error($con));
$arrVal = array();
$i=1;

while ($rowList = mysqli_fetch_array($sqltran)) 
{
    $time=strtotime( $rowList['date']);
    setlocale (LC_TIME, "nl_NL"); 
    $dutch_date = strftime("%A %e %B %Y", $time);
  
    $name = array(
	    'date'=> $dutch_date,
   		'route'=> $rowList['route'],
   		'id' => $rowList['id'],
		'price'=> $rowList['price'],
		'places'=> $rowList['places']
		);		

	array_push($arrVal, $name);	
	$i++;			
}
 
echo  json_encode($arrVal);		
mysqli_close($con);

?>   
 
