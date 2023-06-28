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
    <link rel="stylesheet" href="../../CSS/resize.css">
    
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
    <div class="afspraakContain">
        <form method="POST">
            <input type="text" class="form form1" name="naam_bezoeker" placeholder="Bezoeker volledige naam . . ." required><br>
            <input type="email" class="form form2" name="email_bezoeker" placeholder="Email . . ." required><br>
            <input type="text" class="form form2" name="naam_gevangenen" placeholder="Gevangenen volledige naam . . ." required><br>
            <input type="text" class="form form2" name="reden_bezoek" placeholder="Reden bezoek . . ." required><br>
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
        $emailbezoeker = $_POST['email_bezoeker'];
        $naamgevangenen = $_POST['naam_gevangenen'];
        $redenbezoek = $_POST['reden_bezoek'];
        $tijd = $_POST['bezoek_tijd'];
        $datum = $_POST['bezoek_datum'];
        $create_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO bezoekers SET naam_bezoeker = :naam_bezoeker, email_bezoeker = :email_bezoeker, naam_gevangenen = :naam_gevangenen, reden_bezoek = :reden_bezoek,
        tijd = :tijd, datum = :datum, create_date = :create_date";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':naam_bezoeker' => $naambezoeker,
            ':email_bezoeker' => $emailbezoeker,
            ':naam_gevangenen' => $naamgevangenen,
            ':reden_bezoek' => $redenbezoek,
            ':tijd' => $tijd,
            ':datum' => $datum,
            ':create_date' => $create_date
        ]);

        $melding = "";
        $email = [];
        $email[] = htmlspecialchars($_POST['email_bezoeker']);

        // deze function genereert een token 64 tekens lang.
        $token = bin2hex(random_bytes(32));
        $timestamp = new DateTime("now");
        $timestamp = $timestamp->getTimestamp();
        // sla de token en timestamp voor deze klant in de database

        include("mail.php");
        // $email = $_POST['email_bezoeker'];

        $onderwerp = "Verzoek voor bezoek";
        $bericht = "<p>Wij gaan uw verzoek reviewen!</p>
                    <p>Wanneer wij klaar zijn krijgt u een email met de uitslag.</p>
                    <p>- Team HoornHack</p>";
        try{
            Mailen($email, "bezoeker", $onderwerp, $bericht);
            $melding = 'Open je mail om verder te gaan.';
        } catch(Exception $e){
            $melding = 'Kon geen mail sturen - ' + $e->getMessage();
        }
        echo "<div id='melding'>".$melding."</div>";
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