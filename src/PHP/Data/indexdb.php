<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome user!</title>
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
         

        <div class="log">
            <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php

        require_once("inc/db_conn.php");
        if (!isset($_SESSION['uname'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
       <div class="menuContain">
        <span class="menuTitle"> Gebruikersportaal </span>
             <button class="btnStyle btn3"> <a href="overzicht_gevangenen.php"> Overzicht - Gevangenen</a></button>
             <button class="btnStyle btn4"> <a href="overzicht_personeel.php"> Overzicht - Personeel</a></button>
             <button class="btnStyle btn5"> <a href="overzicht_bezoeken.php"> Overzicht - Bezoeken <i class="fa fa-solid fa-star" id="melding" style="color: #f67b3c;"></i></i></a></button>
             <button class="btnStyle btn6"> <a href="beheersmodule.php">Beheersmodule <i class="fa fa-solid fa-arrow-right" style="color: #000;"></i></a></button>
        </div>
    </content>


    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })

        $(".btn3").click(function () {
            location.replace("overzicht_gevangenen.php")
        })
        
        $(".btn4").click(function () {
            location.replace("overzicht_personeel.php")
        })
        
        $(".btn5").click(function () {
            location.replace("overzicht_bezoeken.php")
        })

        $(".btn6").click(function () {
            location.replace("beheersmodule.php")
        })

        document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the flag from localStorage
        var buttonClicked = localStorage.getItem('buttonClicked');

        // Check if the flag is set
        if (buttonClicked === 'true') {
            // Modify the element's display property
            var element = document.getElementById('melding');
            element.style.display = 'contents';

            // Reset the flag in localStorage
            localStorage.setItem('buttonClicked', 'false');
        }
        });
    </script>
</body>
</html>