<?php 

$name = $_POST["name"];
$subject = $_POST["subject"];
$content = $_POST["content"];
$mail =  $_POST["mail"];


mail("info@rondevanjoris.be", "From: [" . $mail . "] -> " . $subject, $content, "From: info@rondevanjoris.be");

echo "<br> Bedankt! <br>";
echo "<br> Mail gestuurd naar: info@rondevanjoris.be <br>";
echo "<br> Mail gestuurd voor: " . $mail . " <br>";
echo "<br> Onderwerp: " .  $subject . " <br>";
echo "<br> Bericht: " .  $content . " <br>";


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