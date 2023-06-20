<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gevangenen toevoegen</title>

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

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>

        <div class="dataContainAdd">
            <form method="POST">
                <input type="text" class="form form2" name="functie_id" placeholder="Functie ID . . ." required><br>
                <input type="text" class="form form2" name="functie_naam" placeholder="Functie naam . . ." required><br>
                <input type="submit" name="terug" value="Terug" class="return">
                <input type="submit" name="submit" value="Submit" class="submit">
            </form>
        
    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            echo '<div id="confirm">Actie succesvol</div>';
            echo '<script>setTimeout(function(){
                document.getElementById("confirm").style.display = "none";
                window.location.href="../beheer/overzicht_functie.php";
            }, 2000);</script>';
            $functieid = $_POST['functie_id'];
            $functienaam= $_POST['functie_naam'];

            $sql = "INSERT INTO functie SET functie_id = :functie_id, functie_naam = :functie_naam";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':functie_id' => $functieid,
                ':functie_naam' => $functienaam
            ]);
        }
    ?>  
    </div>

        
    </content>

    <script>
        $(".log").click(function() {
            location.replace("../logout.php")
        })

        $(".return").click(function () {
            location.replace("../beheer/overzicht_functie.php")
        })

    </script>
</body>
</html>