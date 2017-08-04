<?php 

require 'db.php';

$name = mysqli_real_escape_string($con, $_POST["realname"]);
$mail =  mysqli_real_escape_string($con, $_POST["mail"]);
$gsm = mysqli_real_escape_string($con, $_POST["gsm"]);
$opm = mysqli_real_escape_string($con, $_POST["opm"]);
$mail_ronde_van_joris = "info@rondevanjoris.com";
$aantal = $_POST["aantal"];
date_default_timezone_set('Europe/Brussels');
$date_email = date("d/m/Y H:i:s");
$route_id = mysqli_real_escape_string($con, $_POST["myselect"]);
$opm = (strlen($opm)>0)?$opm:"NEE";
$gsm = (strlen($gsm)>0)?$gsm:"NEE";

$sql_route_possible = "SELECT date, route, places, id, price from routes where places >= '" . $aantal . "' AND id = '" . $route_id . "'";
$sqltran = mysqli_query($con, $sql_route_possible) or die(mysqli_error($con));

$i=0;
$single_row=NULL;
while($rowList = mysqli_fetch_array($sqltran))
{
    $single_row = $rowList;
    $i++;
}

if($i==1 and $single_row != NULL)
{
    $route = $single_row['route'];
    $places = $single_row['places'];
    $date = $single_row['date'];
    $id= $single_row['id'];
    $single_price = intval($single_row['price']);
    $total_price = $single_price * $aantal;
    $time=strtotime($date);
    setlocale (LC_TIME, "nl_NL"); 
    $date = strftime("%A %e %B %Y", $time);
    
    $html_str_klant = "Bedankt " . $name . "!" .
        "<br> Je inschrijving voor de ". $route. " op " .$date." is gelukt voor: " . $aantal. " Personen".
        "<br> Je krijgt direct een e-mail ter bevestiging.".
        "<br> Is dit fout? Stuur dan een e-mail naar ".$mail_ronde_van_joris."<br>".
        "<br>";

    $mail_str_klant = "Beste ".$name.",". 
        "\n\nJe inschrijving voor de ". $route. " op " .$date." is gelukt voor: " . $aantal. " Personen".
        "\nGelieve " . strval($total_price) . " EUR over te schrijven op rekeningnummer: BE88 3631 6730 5741 ten minste 48 uur voor de start van de route.".
        "\nVoor praktische afspraken in verband met de route kan je terecht op de website.".
        "\n\nGroetjes,".
        "\nRonde Van Joris";
        
    $places_reduced = $places - $aantal;
    $sql_update_routes = "UPDATE routes set places=".$places_reduced." WHERE id=".$id;
    $sqltran = mysqli_query($con, $sql_update_routes) or die(mysqli_error($con));
    
    //build email
    $mail_str = "naam: ".$name . 
            "\ne-mail: ".$mail.
            "\nroute: ".$route.
            "\nroute id: ".$id.
            "\nroute datum: ".$date.
            "\ndatum + time e-mail: ".$date_email.
            "\naantal personen: ".$aantal. 
            "\nopmerking: ".$opm. 
            "\ngsm: ".$gsm . 
            "\n\n";
        
    //mail klant
    mail($mail, "From: [" . $mail_ronde_van_joris . "] -> Reservering gelukt", $mail_str_klant, "From:".$mail_ronde_van_joris."\r\nReply-To:".$mail_ronde_van_joris);
    echo $html_str_klant;
    // mail ronde van joris
    mail($mail_ronde_van_joris, "From: [" . $mail . "] -> " . $name, $mail_str, "From:".$mail_ronde_van_joris."\r\nReply-To:".$mail);
    
    //I will save the email address and date and content of the message in a table
    $klanten_sql = "INSERT INTO klanten (email, message, name, gsm, routeid, places) VALUES('". $mail ."','". $mail_str. "','". $name . "','" . $gsm . "','". $id . "','" . $aantal . "')";
    $sqltran = mysqli_query($con, $klanten_sql ) or die(mysqli_error($con));

}
else 
{
    $html_str_klant = "Bedankt " . $name . "!" .
        "<br> Je inschrijving voor de ". $route. " op " .$date_reserved." voor " . $aantal. " personen is niet gelukt, route is volzet.".
        "<br> Vragen? Aarzel dan niet om een e-mailtje te sturen naar ".$mail_ronde_van_joris."<br>".
        "<br>";
    echo $html_str_klant;
}

mysqli_close($con);
?>

<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/bike.ico" type="image/x-icon" />
    <title>Ronde van Joris</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
</head>

<body>
    <br>
    <a href="http://rondevanjoris.com" class="btn btn-success" role="button" aria-disabled="true">Back</a>
</body>
</html> 