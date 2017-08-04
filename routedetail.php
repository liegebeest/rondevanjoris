<?php 

require 'db.php';
$sqltran = mysqli_query($con, "SELECT id, detail, includes, price, pitch FROM routedetail") or die(mysqli_error($con));
$arrVal = array();
$i=1;

while ($rowList = mysqli_fetch_array($sqltran)) 
{
    $name = array(
	    'id'=> $rowList['id'],
   		'detail'=> $rowList['detail'],
   		'includes' => $rowList['includes'],
		'price'=> $rowList['price'],
		'pitch'=> $rowList['pitch']
		);		

	array_push($arrVal, $name);	
	$i++;			
}
 
echo  json_encode($arrVal);		
mysqli_close($con);

?>   
 