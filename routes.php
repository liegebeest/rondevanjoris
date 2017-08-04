<?php 

require 'db.php';
$sqltran = mysqli_query($con, "SELECT date, route, price, places, id, fotolink FROM routes where month(routes.`date`) >= month(now())-3 AND month(routes.`date`) <= month(now())+3 ORDER BY date ASC")or die(mysqli_error($con));
$arrVal = array();
$i=1;

while ($rowList = mysqli_fetch_array($sqltran)) 
{
    $passed_route = true;
    $now = time();
    $time=strtotime($rowList['date']);
    if($time > $now)
    {
        $passed_route = false;
    }
    $places = $passed_route?'-':$rowList['places'];
    $price  =$passed_route?'-':$rowList['price'];
    
    setlocale (LC_TIME, "nl_NL"); 
    $dutch_date = strftime("%A %e %B %Y", $time);
  
    $name = array(
	    'date'=> $dutch_date,
   		'route'=> $rowList['route'],
   		'id' => $rowList['id'],
		'price'=> $price,
		'places'=> $places,
		'fotolink' => $rowList['fotolink']
		);		

	array_push($arrVal, $name);	
	$i++;			
}
 
echo  json_encode($arrVal);		
mysqli_close($con);

?>   
 