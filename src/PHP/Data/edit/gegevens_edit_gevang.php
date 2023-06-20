<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit gevangenen</title>

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

    $sql="SELECT * FROM gevangenen";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM gevangenen WHERE id_gevangenen = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        Naam:
        <input type="text" class="editInput" id="naam_gevangenen" placeholder="Naam . . ." name="naam_gevangenen" value="<?php echo $row['naam_gevangenen'] ?>"><br>
        Woonplaats:
        <input type="text" class="editInput" id="woonplaats" placeholder="Woonplaats . . ." name="woonplaats" value="<?php echo $row['woonplaats'] ?>"><br>
        Begin Straf:
        <input type="text" class="editInput" id="begin_straf" placeholder="Begin Straf . . ." name="begin_straf" value="<?php echo $row['begin_straf'] ?>"><br>
        Eind Straf:
        <input type="text" class="editInput" id="eind_straf" placeholder="Eind Straf . . ." name="eind_straf" value="<?php echo $row['eind_straf'] ?>"><br>
        Vleugel Cel ID:
        <input type="text" class="editInput" id="vleugel_cel_id" placeholder="Vleugel Cel ID . . ." name="vleugel_cel_id" value="<?php echo $row['vleugel_cel_id'] ?>"><br>
        Opmerking:
        <input type="text" class="editInput" id="opmerking" placeholder="Opmerking . . ." name="opmerking" value="<?php echo $row['opmerking'] ?>"><br>
        <input type="button" onclick="location.href='../overzicht_gevangenen.php';" value="Terug" class="editInputBtn e1"/>
        <input type="submit" class="editInputBtn e2" name="submit" value="Save">
    </form>
</div>

<?php 
require_once("../inc/db_conn.php");
    if (isset($_POST['submit'])) {
        echo '<div id="confirm">Actie succesvol</div>';
        echo '<script>setTimeout(function(){
            document.getElementById("confirm").style.display = "none";
            window.location.href="../overzicht_gevangenen.php";
        }, 2000);</script>';
        $naamgevangenen= $_POST['naam_gevangenen'];
        $woonplaats = $_POST['woonplaats'];
        $beginstraf = $_POST['begin_straf'];
        $eindstraf = $_POST['eind_straf'];
        $vcid = $_POST['vleugel_cel_id'];
        $opmerking = $_POST['opmerking'];

        $sql = "UPDATE gevangenen SET naam_gevangenen = :naam_gevangenen, woonplaats = :woonplaats, 
        begin_straf = :begin_straf, eind_straf = :eind_straf, vleugel_cel_id = :vleugel_cel_id, opmerking = :opmerking WHERE id_gevangenen = :id_gevangenen";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_gevangenen' => $naamgevangenen,
            ':woonplaats' => $woonplaats,
            ':begin_straf' => $beginstraf,
            ':eind_straf' => $eindstraf,
            ':vleugel_cel_id' => $vcid,
            ':opmerking' => $opmerking,
            ':id_gevangenen' => $id

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
