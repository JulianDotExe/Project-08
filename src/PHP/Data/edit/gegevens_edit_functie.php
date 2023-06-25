<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit functie</title>

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

    require_once("../class/permission_class.php");

    $pageTitle = "Functie edit";
    $emailUser = $_SESSION['gebruikersnaam'];

    $objCheckRecht = new Permission($pdo);
    $CheckRecht = $objCheckRecht->CheckPagePermission($pageTitle, $emailUser);

    $sql="SELECT * FROM functie";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM functie WHERE functie_id = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        Functie Naam:
        <input type="text" class="editInput" id="functie_naam" placeholder="Functie naam . . ." name="functie_naam" value="<?php echo $row['functie_naam'] ?>"><br>
        <input type="button" onclick="location.href='../beheer/overzicht_functie.php';" value="Terug" class="editInputBtn e1"/>
        <input type="submit" class="editInputBtn e2" name="submit" value="Save">
    </form>
</div>

<?php 
require_once("../inc/db_conn.php");
    if (isset($_POST['submit'])) {
        echo '<div id="confirm">Actie succesvol</div>';
        echo '<script>setTimeout(function(){
            document.getElementById("confirm").style.display = "none";        
            window.location.href="../beheer/overzicht_functie.php";
        }, 2000);
        </script>';
        $functienaam = $_POST['functie_naam'];

        $sql = "UPDATE functie SET functie_naam = :functie_naam WHERE functie_id = :functie_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':functie_id' => $id,
            ':functie_naam' => $functienaam
        ]);
    }
?>

    <script>
        $(".log").click(function() {
            location.replace("../logout.php")
        })
    </script>
</body>
</html>    
