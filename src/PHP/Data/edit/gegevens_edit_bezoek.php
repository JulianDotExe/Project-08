<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit bezoekers</title>

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

    $pageTitle = "Bezoek edit";
    $emailUser = $_SESSION['gebruikersnaam'];
    

    $objCheckRecht = new Permission($pdo);
    $CheckRecht = $objCheckRecht->CheckPagePermission($pageTitle, $emailUser);


    $sql="SELECT * FROM bezoekers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM bezoekers WHERE bezoek_id = $id");
    $row = $series->fetch();
?>


<div class="editContain">
    <form method="POST">
        Naam bezoeker:
        <input type="text" class="editInput" id="naam_bezoeker" placeholder="Naam bezoeker . . ." name="naam_bezoeker" value="<?php echo $row['naam_bezoeker'] ?>"><br>
        Naam gevangenen:
        <input type="text" class="editInput" id="naam_gevangenen" placeholder="Naam gevangenen . . ." name="naam_gevangenen" value="<?php echo $row['naam_gevangenen'] ?>"><br>
        Tijd:
        <input type="time" class="editInput" id="tijd" placeholder="Tijdstip . . ." name="tijd" value="<?php echo $row['tijd'] ?>"><br>
        Datum:
        <input type="date" class="editInput" id="datum" placeholder="Datum . . ." name="datum" value="<?php echo $row['datum'] ?>"><br>
        <input type="button" onclick="location.href='../overzicht_bezoeken.php';" value="Terug" class="editInputBtn e1"/>
        <input type="submit" class="editInputBtn e2" name="submit" value="Save">
    </form>
</div>

<?php 
require_once("../inc/db_conn.php");
    if (isset($_POST['submit'])) {
        echo '<div id="confirm">Actie succesvol</div>';
        echo '<script>setTimeout(function(){
            document.getElementById("confirm").style.display = "none";        
            window.location.href="../overzicht_bezoeken.php";
        }, 2000);
        </script>';
        $naam_bezoeker= $_POST['naam_bezoeker'];
        $email_bezoeker = $_POST['email_bezoeker'];
        $naam_gevangenen = $_POST['naam_gevangenen'];
        $tijd = $_POST['tijd'];
        $datum = $_POST['datum'];

        $sql = "UPDATE bezoekers SET naam_bezoeker = :naam_bezoeker, email_bezoeker = :email_bezoeker, naam_gevangenen = :naam_gevangenen, 
        tijd = :tijd, datum = :datum WHERE bezoek_id = :bezoek_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_bezoeker' => $naam_bezoeker,
            ':email_bezoeker' => $email_bezoeker,
            ':naam_gevangenen' => $naam_gevangenen,
            ':tijd' => $tijd,
            ':datum' => $datum,
            ':bezoek_id' => $id
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
