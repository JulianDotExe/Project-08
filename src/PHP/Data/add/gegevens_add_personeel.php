<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <link rel="stylesheet" href="../../../CSS/main.css">
    
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
            <span id="tekstlog"> <a href="../logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php

        require_once("../inc/db_conn.php");
        if (!isset($_SESSION['uname'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='../login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
       <div class="sidebar">
             <!-- <button class="btnStyle btn1"> Sorteer - Vleugel </button>
             <button class="btnStyle btn2"> Sorteer - Naam </button> -->

             <button class="btnStyle btn3"> <a href="../overzicht_gevangenen.php"> Overzicht - Gevangenen </a></button>
             <button class="btnStyle btn4"> <a href="../overzicht_personeel.php"> Overzicht - Personeel </a></button>
             <button class="btnStyle btn5"> <a href="../overzicht_bezoeken.php"> Overzicht - Bezoeken </a></button>
        </div>

        <div class="dataContainAdd">
            <form method="POST">
                <input type="text" class="form form2" name="personeel_id" placeholder="ID . . ."><br>
                <input type="text" class="form form2" name="naam" placeholder="Volledige naam . . ."><br>
                <input type="text" class="form form3" name="wachtwoord" placeholder="Wachtwoord . . ."><br>
                <input type="text" class="form form4" name="gebruikersnaam" placeholder="Gebruikersnaam . . ."><br>
                <input type="text" class="form form4" name="functie" placeholder="Functie . . ."><br><br><br>
                <input type="submit" name="submit" value="Submit" class="form formAdd"><br><br>
                <input type="submit" name="terug" value="Terug" class="form formAdd">
            </form>
        
    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            $personeelid = $_POST['personeel_id'];
            $naam= $_POST['naam'];
            $wachtwoord = $_POST['wachtwoord'];
            $gebruikersnaam = $_POST['gebruikersnaam'];
            $functie = $_POST['functie'];
            
            $sql = "INSERT INTO personeel SET personeel_id = :personeel_id, naam = :naam, wachtwoord = :wachtwoord, 
            gebruikersnaam = :gebruikersnaam, functie = :functie";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':personeel_id' => $personeelid,
                ':naam' => $naam,
                ':wachtwoord' => $wachtwoord,
                ':gebruikersnaam' => $gebruikersnaam,
                ':functie' => $functie,
            ]);
        }

        if(isset($_POST['terug'])) {
            echo "<script>location.href='../overzicht_personeel.php'</script>";
            header("Location: ../overzicht_personeel.php");
            exit();
        }
    ?>
        
        </div>

        
    </content>

    <script>
        $(".log").click(function() {
            location.replace("../logout.php")
        })

        $(".btn3").click(function () {
            location.replace("../overzicht_gevangenen.php")
        })

        
        $(".btn4").click(function () {
            location.replace("../overzicht_personeel.php")
        })

        
        $(".btn5").click(function () {
            location.replace("../overzicht_bezoeken.php")
        })
    </script>
</body>
</html>