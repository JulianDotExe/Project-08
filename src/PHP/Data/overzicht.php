<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    
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
    ?>

    <content>
       <div class="sidebar">
             <button class="btnStyle btn1"> Sorteer - Vleugel </button>
             <button class="btnStyle btn2"> Sorteer - Naam </button>

             <button class="btnStyle btn3"> Overzicht - Gevangenen </button>
             <button class="btnStyle btn4"> Overzicht - Personeel </button>
             <button class="btnStyle btn5"> Overzicht - Bezoeken </button>

             <button class="btnStyle btn6"> Gegevens - Toevoegen </button>
             <button class="btnStyle btn7"> Gegevens - Bewerken </button>
        </div>

        <div class="dataContain">
            <?php // include("inc/menu.php") ?>
        </div>
    </content>

    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })
    </script>
</body>
</html>