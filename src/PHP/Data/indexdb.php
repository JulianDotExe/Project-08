<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome user!</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/resize.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->

</head>
<body>
    <div class="background backgroundLight"></div>

    <header>
        <div class="logo"></div>
         

        <div class="header">
            <i class="fa fa-solid fa-power-off fa-lg log" style="color: #f67b50;"></i>
            <span id="tekstlog" class="log"> <a href="logout.php"> Log out</a></span><br><br>
            <i class="fa fa-solid fa-gear fa-lg bh" style="color: #f67b3c;"></i>
            <span id="tekstlog"> <a href="beheersmodule.php"> Beheer</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php

        require_once("inc/db_conn.php");
        if (!isset($_SESSION['uname'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
       <div class="menuContain">
        <span class="menuTitle"> Gebruikersportaal </span>
             <button class="btnStyle btn3"> <a href="overzicht_gevangenen.php"> Overzicht - Gevangenen</a></button>
             <button class="btnStyle btn5" id="meldingDis"> <a href="overzicht_bezoeken.php" id="meldingDis"> Overzicht - Bezoeken <i class="fa fa-solid fa-star" id="melding" style="color: #f67b3c;"></i></i></a></button>
        </div>
    </content>


    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })

        $(".bh").click(function() {
            location.replace("beheersmodule.php")
        })

        $(".btn3").click(function () {
            location.replace("overzicht_gevangenen.php")
        })
        
        
        $(".btn5").click(function () {
            location.replace("overzicht_bezoeken.php")
        })

        document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the flag from localStorage
        var buttonClicked = localStorage.getItem('buttonClicked');

        // Check if the flag is set
        if (buttonClicked === 'true') {
            // Modify the element's display property
            var element = document.getElementById('melding');
            element.style.display = 'contents';

            // Reset the flag in 
        document.getElementById('meldingDis').addEventListener('click', function() {
            localStorage.setItem('buttonClicked', 'false');
                });
             }
        });
    </script>
</body>
</html>