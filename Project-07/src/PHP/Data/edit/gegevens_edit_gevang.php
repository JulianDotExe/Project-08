<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit gevangenen</title>
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

    $sql="SELECT * FROM gevangenen";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM gevangenen WHERE gevangenen_id = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        <input type="text" class="editInput" id="naam" placeholder="Naam . . ." name="naam" value="<?php echo $row['naam'] ?>"><br>
        <input type="text" class="editInput" id="woonplaats" placeholder="Woonplaats . . ." name="woonplaats" value="<?php echo $row['woonplaats'] ?>"><br>
        <input type="text" class="editInput" id="begin_straf" placeholder="Begin Straf . . ." name="begin_straf" value="<?php echo $row['begin_straf'] ?>"><br>
        <input type="text" class="editInput" id="eind_straf" placeholder="Eind Straf . . ." name="eind_straf" value="<?php echo $row['eind_straf'] ?>"><br>
        <input type="text" class="editInput" id="cel_nummer" placeholder="Cel Nummer . . ." name="cel_nummer" value="<?php echo $row['cel_nummer'] ?>"><br>
        <input type="text" class="editInput" id="vleugel" placeholder="Vleugel . . ." name="vleugel" value="<?php echo $row['vleugel'] ?>"><br>
        <input type="text" class="editInput" id="opmerking" placeholder="Opmerking . . ." name="opmerking" value="<?php echo $row['opmerking'] ?>"><br>
        <input type="submit" class="editInputBtn" name="submit" value="Edit">
        <input type="button" onclick="location.href='../overzicht_gevangenen.php';" value="Terug" class="editInputBtn"/>
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
        $naam= $_POST['naam'];
        $woonplaats = $_POST['woonplaats'];
        $beginstraf = $_POST['begin_straf'];
        $eindstraf = $_POST['eind_straf'];
        $celnummer = $_POST['cel_nummer'];
        $vleugel = $_POST['vleugel'];
        $opmerking = $_POST['opmerking'];

        $sql = "UPDATE gevangenen SET naam = :naam, woonplaats = :woonplaats, 
        begin_straf = :begin_straf, eind_straf = :eind_straf, cel_nummer = :cel_nummer, vleugel = :vleugel, opmerking = :opmerking WHERE gevangenen_id = :gevangenen_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam' => $naam,
            ':woonplaats' => $woonplaats,
            ':begin_straf' => $beginstraf,
            ':eind_straf' => $eindstraf,
            ':cel_nummer' => $celnummer,
            ':vleugel' => $vleugel,
            ':opmerking' => $opmerking,
            ':gevangenen_id' => $id

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
