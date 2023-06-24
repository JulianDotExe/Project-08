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
                <input type="text" class="form form2" name="id_gevangenen" placeholder="Gevangenen ID . . ." required><br>
                <input type="text" class="form form2" name="naam_gevangenen" placeholder="Gevangenen volledige naam . . ." required><br>
                <input type="text" class="form form3" name="woonplaats" placeholder="Woonplaats . . ." required><br>
                <input type="date" class="form form4" name="begin_straf" placeholder="Datum begin straf . . ." required><br>
                <input type="date" class="form form4" name="eind_straf" placeholder="Datum eind straf . . ." required><br>
                <input type="text" class="form form4" name="cel_nummer" placeholder="Cel nummer . . ." required><br>
                <input type="text" class="form form4" name="vleugel" placeholder="Vleugel . . ." required><br>
                <input type="text" class="form form4" name="opmerking" placeholder="Opmerking . . ."><br>
                <input type="submit" name="terug" value="Terug" class="return">
                <input type="submit" name="submit" value="Submit" class="submit">
            </form>
        
    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            echo '<div id="confirm">Actie succesvol</div>';
            echo '<script>setTimeout(function(){
                document.getElementById("confirm").style.display = "none";
                window.location.href="../overzicht_gevangenen.php";
            }, 2000);</script>';
            $idgevangenen = $_POST['id_gevangenen'];
            $gevangenennaam= $_POST['naam_gevangenen'];
            $woonplaats = $_POST['woonplaats'];
            $beginstraf = $_POST['begin_straf'];
            $eindstraf = $_POST['eind_straf'];
            $celnummer = $_POST['cel_nummer'];
            $vleugel = $_POST['vleugel'];
            $opmerking = $_POST['opmerking'];

            $sql = "INSERT INTO gevangenen SET id_gevangenen = :id_gevangenen, naam_gevangenen = :naam_gevangenen, woonplaats = :woonplaats, 
            begin_straf = :begin_straf, eind_straf = :eind_straf, cel_nummer = :cel_nummer, vleugel = :vleugel, opmerking = :opmerking";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id_gevangenen' => $idgevangenen,
                ':naam_gevangenen' => $gevangenennaam,
                ':woonplaats' => $woonplaats,
                ':begin_straf' => $beginstraf,
                ':eind_straf' => $eindstraf,
                ':cel_nummer' => $celnummer,
                ':vleugel' => $vleugel,
                ':opmerking' => $opmerking
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
            location.replace("../overzicht_gevangenen.php")
        })
    </script>
</body>
</html>