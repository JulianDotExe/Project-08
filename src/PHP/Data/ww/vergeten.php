<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vergeten</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="../../../CSS/main.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- External Scripts -->

</head>
<body>
 <div class="background backgroundLight"></div>

    <header>
        <div class="logo"></div>
    </header>

    <?php
    require_once("../inc/db_conn.php");
    ?>

    <div class="menuContain">
        <form name="wachtwoord vergeten" method="POST" enctype="multipart/form-data" action="">
            <p class="resetTitle">Reset wachtwoord</p>
            <input type="email" name="email" placeholder="email" class="form form2" required/>        <br/>

            <!-- <div class="g-recaptcha" data-sitekey="6LfT_hslAAAAAHm2MXbg-mt_RES4-hrz9BwUGlU4"></div>
            <br/> -->

            <input type="submit" name="terug" class="return" value="Terug">
            <input type="submit" class="submit" id="submit"  name="submit" value="Submit" />

        </form>
    </div>

<?php
    if(isset($_POST["submit"])) {
        $melding = "";
        $email = htmlspecialchars($_POST['email']);

        // deze function genereert een token 64 tekens lang.
        $token = bin2hex(random_bytes(32));
        $timestamp = new DateTime("now");
        $timestamp = $timestamp->getTimestamp();
        // sla de token en timestamp voor deze klant in de database
        try {
            $sql = "UPDATE personeel SET token = ? WHERE email_personeel = ?";
            $stmt = $pdo->prepare($sql);
            $stmt = $stmt->execute(array($token, $email));
            if(!$stmt) {
                echo "<script>alert('Kon niet opslaan in database.');</script>";
            }
        }catch(PDOException $e) {
            echo $e->getMessage();
        }

        // hier wordt het path naar wachtwoord_wijzigen.php gegenereerd
        $url = sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ?
            'https' : 'http', $_SERVER['HTTP_HOST'].
            dirname($_SERVER['PHP_SELF'])."/wachtwoord_resetten.php");
        $url = $url."?token=".$token."&timestamp=".$timestamp;

        // stuur url naar het email adres van de klant
        include("../mail.php");
        $email = $_POST["email"];
        // Controleer of het e-mailadres bestaat in de database
        $stmt = $pdo->prepare("SELECT * FROM personeel WHERE email_personeel = :email_personeel");
        $stmt->bindParam(":email_personeel", $email);
        $stmt->execute();
        $email = $stmt->fetch(PDO::FETCH_ASSOC);

        $onderwerp = "Wachtwoord resetten";
        $bericht = "<p>Als je je wachtwoord wilt resetten klik <a href=".$url.">hier</a></p>";
        try{
            Mailen($email, "medewerker", $onderwerp, $bericht);
            $melding = 'Open je mail om verder te gaan.';
        } catch(Exception $e){
            $melding = 'Kon geen mail sturen - ' + $e->getMessage();
        }
        echo "<div id='melding'>".$melding."</div>";
    }
?>

<script>
    $(".return").click(function() {
        location.replace("../login.php")
    });
</script>

    
</body>
</html>
