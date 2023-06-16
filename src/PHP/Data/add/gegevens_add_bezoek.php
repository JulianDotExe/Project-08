<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezoeker toevoegen</title>
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

        $stmt = $pdo->prepare("SELECT functie FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>

        <div class="dataContainAdd">
            <form method="POST">
                <input type="text" class="form form1" name="bezoek_id" placeholder="Bezoek ID . . ." required><br>
                <input type="text" class="form form2" name="naam_bezoeker" placeholder="Bezoeker volledige naam . . ." required><br>
                <input type="text" class="form form3" name="naam_gevangenen" placeholder="Gevangenen volledige naam . . ." required><br>
                <input type="time" class="form form3" name="tijd" placeholder="Tijdstip" min="12:00:00" max="16:00:00" required><br>
                <input type="date" class="form form4" name="datum" placeholder="Datum" required><br><br>
                <input type="submit" name="submit" value="Submit" class="form formAdd"><br>
                <input type="submit" name="terug" value="Terug" class="form formAdd return">
            </form>
        
    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            echo '<div id="confirm">Actie succesvol</div>';
            echo '<script>setTimeout(function(){
                document.getElementById("confirm").style.display = "none";
                window.location.href="../overzicht_bezoeken.php";
            }, 2000);</script>';
            $bezoek_id = $_POST['bezoek_id'];
            $naam_bezoeker = $_POST['naam_bezoeker'];
            $naam_gevangenen= $_POST['naam_gevangenen'];
            $tijd = $_POST['tijd'];
            $datum = $_POST['datum'];
  

            $sql = "INSERT INTO bezoekers SET bezoek_id = :bezoek_id, naam_bezoeker = :naam_bezoeker, naam_gevangenen = :naam_gevangenen, 
            tijd = :tijd, datum = :datum";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':bezoek_id' => $bezoek_id,
                ':naam_bezoeker' => $naam_bezoeker,
                ':naam_gevangenen' => $naam_gevangenen,
                ':tijd' => $tijd,
                ':datum' => $datum
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