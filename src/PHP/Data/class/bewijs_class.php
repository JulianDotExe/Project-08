<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewijs</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">
    
    <link rel="stylesheet" href="../../../CSS/main.css">
    <link rel="stylesheet" href="../../../CSS/resize.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->
</head>
<body>

    <?php

    require_once("../inc/db_conn.php");
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }

    $id = $_GET["id"];
    $series = $pdo->prepare("SELECT * FROM bewijsmateriaal WHERE id_gevangenen = :id");
    $series->bindParam(':id', $id);
    $series->execute();
    $row = $series->fetch(PDO::FETCH_ASSOC);

    ?>

<div class="background backgroundLight"></div>

<header>
    <div class="logo"></div>

    <div class="header">
        <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
        <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
        <i class="fa fa-solid fa-x"></i>
    </div>
</header>

<content>
    <div class="back">
        <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
    </div>


    <div class="dataContain dataCenter">
        <table class="table">
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>ID</th>
                                <th>Naam</th>
                                <th id='optional'>Woonplaats</th>
                                <th id='optional'>Begin-straf</th>
                                <th id='optional'>Eind-straf</th>
                                <th>Cel-nummer</th>
                                <th>Opmerking</th>";
                    break;
                    default:
                        echo "  <th>ID</th>
                                <th>Naam</th>
                                <th>Vleugel-Cel-ID</th>
                                <th>Bewijsmateriaal</th>
                                <th>Opmerking</th>
                                <th id='optional'>Actie</th>";
                    break;
                }
            ?>
            </tr>
        </table>
    </div>
</content>

<script>
    $(".header").click(function() {
        location.replace("../logout.php")
    })

    $(".back").click(function() {
        location.replace("../overzicht_gevangenen.php")
    })
</script>

</body>
</html>