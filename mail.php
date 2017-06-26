<?php 

require 'db.php';

$name = mysqli_real_escape_string($con, $_POST["realname"]);
$mail =  mysqli_real_escape_string($con, $_POST["mail"]);
$gsm = mysqli_real_escape_string($con, $_POST["gsm"]);
$date_reserved = $_POST["date"];
$int_route = $_POST["route"];
$aantal = $_POST["aantal"];
$date_email = date("Y-m-d");

switch($int_route){
    case "1": $route="Parelroute"; break;
    case "2": $route="Klassieke route"; break;
    case "3": $route="Individuele Coacing"; break;
}

$mail_str = "naam: ".$name . 
            "\ngsm: ".$gsm . 
            "\ne-mail: ".$mail.
            "\nroute: ".$route.
            "\ndatum reservatie: ".$date_reserved.
            "\naantal personen: ".$aantal . 
            "\n\n";
            
$html_str = "<html> naam: " . $name . 
            "<br> gsm: " . $gsm . 
            "<br> e-mail: ".$mail.
            "<br> route: ".$route.
            "<br> datum reservatie: ". $date_reserved.
            "<br> aantal personen: ".$aantal. 
            "</html>";

mail("info@rondevanjoris.be", "From: [" . $mail . "] -> " . $name, $mail_str, "From: info@rondevanjoris.be");

echo "Bedankt!<br><br>";
echo "Volgende gegevens werden verstuurd:<br><br>";
echo $html_str;
echo "<br><br>";
echo "Je krijgt spoedig een e-mail als je reservatie is ingeboekt.<br>";
echo "Is dit fout? Stuur dan een e-mail naar info@rondevanjoris.be<br>";
echo "<br>";

//I will save the email address and date and content of the message in a table
$sqltran = mysqli_query($con, "INSERT INTO klanten VALUES('". $mail ."','". $date_email. "','". $mail_str. "','". $name . "','" . $gsm ."')") or die(mysqli_error($con));


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
