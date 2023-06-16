<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit personeel</title>
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
</header>


<?php
    require_once("../inc/db_conn.php");
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='../login.php'</script>";
    }

    $sql="SELECT * FROM personeel";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM personeel WHERE personeel_id = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        Naam:
        <input type="text" class="editInput" id="naam" placeholder="Naam . . ." name="naam" value="<?php echo $row['naam'] ?>"><br>
        Wachtwoord:
        <input type="text" class="editInput" id="wachtwoord" placeholder="Wachtwoord . . ." name="wachtwoord" value="<?php echo $row['wachtwoord'] ?>"><br>
        Gebruikersnaam:
        <input type="text" class="editInput" id="gebruikersnaam" placeholder="Gebruikersnaam . . ." name="gebruikersnaam" value="<?php echo $row['gebruikersnaam'] ?>"><br>
        Functie:
        <input type="text" class="editInput" id="functie" placeholder="Functie . . ." name="functie" value="<?php echo $row['functie'] ?>"><br>
        <input type="submit" class="editInputBtn" name="submit" value="Save">
        <input type="button" onclick="location.href='../overzicht_personeel.php';" value="Terug" class="editInputBtn"/>
    </form>
</div>

<?php 
require_once("../inc/db_conn.php");
    if (isset($_POST['submit'])) {
        echo '<div id="confirm">Actie succesvol</div>';
        echo '<script>setTimeout(function(){
            document.getElementById("confirm").style.display = "none";
            window.location.href="../overzicht_personeel.php";
        }, 2000);</script>';
        $naam= $_POST['naam'];
        $wachtwoord = $_POST['wachtwoord'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $functie = $_POST['functie'];

        $sql = "UPDATE personeel SET naam = :naam, wachtwoord = :wachtwoord, 
        gebruikersnaam = :gebruikersnaam, functie = :functie WHERE personeel_id = :personeel_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam' => $naam,
            ':wachtwoord' => $wachtwoord,
            ':gebruikersnaam' => $gebruikersnaam,
            ':functie' => $functie,
            ':personeel_id' => $id
        ]);
    }
    // echo "<a href='detail.php?id=" . $row['gevangenen_id'] . "'>Terug</a>";
?>

    <script>
        $(".log").click(function() {
            location.replace("../logout.php")
        })
    </script>
</body>
</html>    
