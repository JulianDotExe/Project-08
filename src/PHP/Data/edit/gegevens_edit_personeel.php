<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit personeel</title>

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
<div class="background backgroundLight"></div>

<header>
    <div class="logo"></div>
</header>


<?php
    require_once("../inc/db_conn.php");
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='../login.php'</script>";
    }

    $sql="SELECT * FROM personeel";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM personeel WHERE id_personeel = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        Naam:
        <input type="text" class="editInput" id="naam_personeel" placeholder="Naam . . ." name="naam_personeel" value="<?php echo $row['naam_personeel'] ?>"><br>
        Gebruikersnaam:
        <input type="text" class="editInput" id="gebruikersnaam" placeholder="Gebruikersnaam . . ." name="gebruikersnaam" value="<?php echo $row['gebruikersnaam'] ?>"><br>
        Functie ID:
        <input type="text" class="editInput" id="functie_id" placeholder="Functie ID. . ." name="functie_id" value="<?php echo $row['functie_id'] ?>"><br>
        Email:
        <input type="text" class="editInput" id="email_personeel" placeholder="Email ID. . ." name="email_personeel" value="<?php echo $row['email_personeel'] ?>"><br>
        <input type="button" onclick="location.href='../beheer/overzicht_personeel.php';" value="Terug" class="editInputBtn e1"/>
        <input type="submit" class="editInputBtn e2" name="submit" value="Save">
    </form>
</div>

<?php 
require_once("../inc/db_conn.php");
    if (isset($_POST['submit'])) {
        echo '<div id="confirm">Actie succesvol</div>';
        echo '<script>setTimeout(function(){
            document.getElementById("confirm").style.display = "none";
            window.location.href="../beheer/overzicht_personeel.php";
        }, 2000);</script>';
        $naam= $_POST['naam_personeel'];
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $functie = $_POST['functie_id'];
        $email_personeel = $_POST['email_personeel'];

        $sql = "UPDATE personeel SET naam_personeel = :naam_personeel, gebruikersnaam = :gebruikersnaam, functie_id = :functie_id, email_personeel = :email_personeel WHERE id_personeel = :id_personeel";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_personeel' => $naam,
            ':gebruikersnaam' => $gebruikersnaam,
            ':functie_id' => $functie,
            ':email_personeel' => $email_personeel,
            ':id_personeel' => $id
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
