<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    
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
    <content>
    <div class="afspraakcontain">
        <form method="POST">
            <input type="text" class="form form1" name="naam_bezoeker" placeholder="Bezoeker volledige naam . . ." required><br>
            <input type="text" class="form form2" name="naam_gevangenen" placeholder="Gevangenen volledige naam . . ." required><br>
            <input type="time" class="form form3" name="bezoek_tijd" placeholder="Tijdstip" min="12:00:00" max="16:00:00" required><br>
            <input type="date" class="form form4" name="bezoek_datum" placeholder="Datum" required><br>
            <input type="button" onclick="location.href='../../../index.php';" value="Terug" class="return "/>    
            <input type="submit" name="submit" value="Submit" class="submit">
        </form>
    </div>

    <?php
    require_once("./inc/db_conn.php");

    if (isset($_POST['submit'])) {
        echo '<div id="confirm">
            <p><input type="submit" id="meldingClick" value="Actie succesvol, klik om door te gaan"></p>
            </div>';
    
        
        $naambezoeker = $_POST['naam_bezoeker'];
        $naamgevangenen= $_POST['naam_gevangenen'];
        $tijd = $_POST['bezoek_tijd'];
        $datum = $_POST['bezoek_datum'];

        $sql = "INSERT INTO bezoekers SET naam_bezoeker = :naam_bezoeker, naam_gevangenen = :naam_gevangenen, tijd = :tijd, 
        datum = :datum";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_bezoeker' => $naambezoeker,
            ':naam_gevangenen' => $naamgevangenen,
            ':tijd' => $tijd,
            ':datum' => $datum
        ]);
    }
    ?>
    </content>

    <script>
        $("#meldingClick").click(function (){
            location.replace("../../../index.php")
        })

        document.getElementById("meldingClick").addEventListener("click", function() {
            localStorage.setItem("buttonClicked", "true");
        });
    </script>
</body>
</html>