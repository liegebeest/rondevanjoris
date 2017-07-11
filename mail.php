<?php 

require 'db.php';

$name = mysqli_real_escape_string($con, $_POST["realname"]);
$mail =  mysqli_real_escape_string($con, $_POST["mail"]);
$gsm = mysqli_real_escape_string($con, $_POST["gsm"]);
$opm = mysqli_real_escape_string($con, $_POST["opm"]);
$mail_ronde_van_joris = "info@rondevanjoris.be";
$gepland_input = mysqli_real_escape_string($con, $_POST["gepland"]);
$date_reserved = $_POST["date"];
$int_route = $_POST["route"];
$aantal = $_POST["aantal"];
$date_email = date("d/m/Y H:i:s"); 

switch($int_route){
    case "1": $route="Parelroute"; break;
    case "2": $route="Klassieke route"; break;
    case "3": $route="Individuele Coacing"; break;
}

switch($gepland_input){
    case "1": $gepland=true; break;
    case "2": $gepland=false; break;
}

$geplande_route_str = $gepland?"JA":"NEE";
$opm = (strlen($opm)>0)?$opm:"NEE";
$gsm = (strlen($gsm)>0)?$gsm:"NEE";

$mail_str = "naam: ".$name . 
            "\ne-mail: ".$mail.
            "\nroute: ".$route.
            "\ndatum route: ".$date_reserved.
            "\ndatum e-mail sent: ".$date_email.
            "\naantal personen: ".$aantal. 
            "\ngeplande route: ". $geplande_route_str.
            "\nopmerking: ".$opm. 
            "\ngsm: ".$gsm . 
            "\n\n";
            
mail($mail_ronde_van_joris, "From: [" . $mail . "] -> " . $name, $mail_str, "From:".$mail_ronde_van_joris."\r\nReply-To:".$mail);

//I will save the email address and date and content of the message in a table
$sqltran = mysqli_query($con, "INSERT INTO klanten VALUES('". $mail ."','". $mail_str. "','". $name . "','" . $gsm ."')") or die(mysqli_error($con));

if($gepland == false)
{
    $html_str_klant = "Bedankt " . $name . "!" .
        "<br> Je inschrijving voor de ". $route. " op " .$date_reserved." voor " . $aantal. " is goed ontvangen.".
        "<br> Je krijgt zo snel mogelijk een e-mail als de route datum past.".
        "<br> Is dit fout? Stuur dan een e-mail naar ".$mail_ronde_van_joris."<br>".
        "<br>";
        
    echo $html_str_klant;
}
else
{
    echo $date_reserved;
    $date = date_create_from_format('d/m/Y', $date_reserved);
    $date_sql = date_format($date, 'Y-m-d');
    echo $date_sql;
    $sql_route_possible = "SELECT * from routes where places >= " . $aantal . " AND date = '" . $date_sql . "'";
    $sqltran = mysqli_query($con, $sql_route_possible) or die(mysqli_error($con));
    echo $sql_route_possible;
    
    $i=0;
    $single_row=NULL;
    while($rowList = mysqli_fetch_array($sqltran))
    {
        $single_row = $rowList;
        $i++;
    }
    
    if($i==1 and $single_row != NULL)
    {
        var_dump($single_row);
        $route = $single_row['route'];
        $places = $single_row['places'];
        $date = $single_row['date'];
        $id= $single_row['id'];
        
        $html_str_klant = "Bedankt " . $name . "!" .
            "<br> Je inschrijving voor de ". $route. " op " .$date_reserved." voor " . $aantal. " personen is gelukt.".
            "<br> Je krijgt direct een e-mail ter bevestiging.".
            "<br> Is dit fout? Stuur dan een e-mail naar ".$mail_ronde_van_joris."<br>".
            "<br>";
        
        $mail_str_klant = "Beste ".$name.",". 
            "\n\nJe inschrijving voor de ". $route. " op " .$date_reserved." voor " . $aantal. " personen is gelukt.".
            "\nVoor praktische afspraken in verband met de route kan je terecht op de website.".
            "\n\nGroetjes,".
            "\nRonde Van Joris";
            
        $places_reduced = $places - $aantal;
        $sql_update_routes = "UPDATE routes set places=".$places_reduced." WHERE id=".$id;
        $sqltran = mysqli_query($con, $sql_update_routes) or die(mysqli_error($con));
            
        mail($mail, "From: [" . $mail_ronde_van_joris . "] -> Reservering gelukt", $mail_str_klant, "From:".$mail_ronde_van_joris."\r\nReply-To:".$mail_ronde_van_joris);
           
        echo $html_str_klant; 
         
        var_dump($mail_str_klant);
        var_dump($route);
        var_dump($places);
        var_dump($date);
        var_dump($aantal);
    }
    else 
    {
        $html_str_klant = "Bedankt " . $name . "!" .
            "<br> Je inschrijving voor de ". $route. " op " .$date_reserved." voor " . $aantal. " personen is niet gelukt.".
            "<br> Foute input".
            "<br> Lukt het niet? Aarzel dan niet om een e-mailtje te sturen naar ".$mail_ronde_van_joris."<br>".
            "<br>";
        echo $html_str_klant;
    }
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
    <a href="http://rondevanjoris.be" class="btn btn-success" role="button" aria-disabled="true">Back</a>
</body>
</html> 
