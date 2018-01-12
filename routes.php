<?php 

require 'db.php';
//$sqltran = mysqli_query($con, "SELECT date, route, price, places, id, fotolink FROM routes where month(routes.`date`) >= month(now())-24 AND month(routes.`date`) <= month(now())+24 ORDER BY date ASC")or die(mysqli_error($con));
$sqltran = mysqli_query($con, "SELECT date, route, price, places, id, fotolink FROM routes ORDER BY date ASC")or die(mysqli_error($con));
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
    
    if($passed_route == false)
    {
        if($rowList['places'] == 0)
        {
            $places = '<i class="btn btn-xs btn-danger" role="button" target="_clean" disabled>FULL</i>';
        }
        else
        {
            $places = $rowList['places'];
        }
    }
    else
    {
        $places = "-";
    }
 
    $price = $passed_route?'-':$rowList['price'];
    
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
 