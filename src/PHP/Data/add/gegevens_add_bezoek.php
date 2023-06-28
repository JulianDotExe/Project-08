<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezoeker toevoegen</title>

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

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>

        <div class="dataContainAdd">
            <form method="POST">
                <input type="text" class="form form2" name="naam_bezoeker" placeholder="Bezoeker volledige naam . . ." required><br>
                <input type="email" class="form form2" name="email_bezoeker" placeholder="Email . . ." required><br>
                <input type="text" class="form form3" name="naam_gevangenen" placeholder="Gevangenen volledige naam . . ." required><br>
                <input type="text" class="form form2" name="reden_bezoek" placeholder="Reden bezoek . . ." required><br>
                <input type="time" class="form form3" name="tijd" placeholder="Tijdstip" min="12:00:00" max="16:00:00" required><br>
                <input type="date" class="form form4" name="datum" placeholder="Datum" required><br>
                <input type="submit" name="terug" value="Terug" class="return">
                <input type="submit" name="submit" value="Submit" class="submit">
            </form>
        
    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            echo '<div id="confirm">Actie succesvol</div>';
            echo '<script>setTimeout(function(){
                document.getElementById("confirm").style.display = "none";
                window.location.href="../overzicht_bezoeken.php";
            }, 2000);</script>';
            $naam_bezoeker = $_POST['naam_bezoeker'];
            $emailbezoeker = $_POST['email_bezoeker'];
            $naam_gevangenen= $_POST['naam_gevangenen'];
            $redenbezoek = $_POST['reden_bezoek'];
            $tijd = $_POST['tijd'];
            $datum = $_POST['datum'];
            $create_date = date('Y-m-d H:i:s');

            $sql = "INSERT INTO bezoekers SET naam_bezoeker = :naam_bezoeker, email_bezoeker = :email_bezoeker, naam_gevangenen = :naam_gevangenen, 
            reden_bezoek = :reden_bezoek, tijd = :tijd, datum = :datum, create_date = :create_date";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':naam_bezoeker' => $naam_bezoeker,
                ':email_bezoeker' => $emailbezoeker,
                ':naam_gevangenen' => $naam_gevangenen,
                ':reden_bezoek' => $redenbezoek,
                ':tijd' => $tijd,
                ':datum' => $datum,
                ':create_date' => $create_date
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
            location.replace("../overzicht_bezoeken.php")
        })

    </script>
</body>
</html>