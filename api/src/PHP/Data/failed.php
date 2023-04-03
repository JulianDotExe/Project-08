<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->
    
</head>
<body>
 <div class="background backgroundLight"></div>

    <content>
    <div class="logocontain">
        <div class="logobig"></div>
        <span id="logocontaintekst">
        <b>Inloggen mislukt.</b><br>
        <b>U wordt terug gestuurd naar de inlogpagina.</b></span>
    </div>

    </content>

<?php
    echo "<script>setTimeout(() => {
        location.href='login.php'
                }, 2500)</script>";
?>

</body>
</html>