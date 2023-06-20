<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezoekers verwijderen</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">

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
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='../login.php'</script>";
    }
    $sql="SELECT * FROM bezoekers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="delContain">
    <form method="POST">
        <h1>Verwijderen bezoekers:</h1>
        <h2>
            <?php 
            $id = $_GET["id"];
            $series = $pdo->query("SELECT * FROM bezoekers WHERE bezoek_id = $id");
            $row = $series->fetch();
            echo $row['naam_bezoeker'];
            ?>
        </h2>
        <b style="color:red; font-size: 18px;">Weet u zeker dat u deze actie wilt uitvoeren?</b>
        <input type="submit" name="terug" class="delBtn" value="Terug">
        <input type="submit" name="verwijderen" class="delBtn delete" value="Verwijderen">
    </form>
</div>

<?php
if(isset($_POST['terug'])) {
    echo "<script>location.href='../overzicht_bezoeken.php'</script>";
    header("Location: ../overzicht_bezoeken.php");
    exit();
}

elseif(isset($_POST['verwijderen'])) {
    $sql = "DELETE FROM bezoekers WHERE bezoek_id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: ../overzicht_bezoeken.php");
    exit();
}
?>

</body>
</html>