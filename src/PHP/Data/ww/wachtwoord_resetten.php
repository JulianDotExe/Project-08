<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoornhack</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="../../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../../CSS/resize.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</head>
<body>

<div class="background backgroundLight"></div>

<header>
    <div class="logo"></div>
</header>


<?php
    // Verbinding maken met de database
    require_once("../inc/db_conn.php");
?>

<div class="resetContain">
<span class="resetTitle">Wachtwoord resetten</span>
    <form name="resetformulier" method="POST"
          enctype="multipart/form-data" action=""
          onsubmit="if(wachtwoord1.value   !== wachtwoord2.value){
                alert('wachtwoorden moeten gelijk zijn!');
                return false;
                }
                ">
        <input required type="email" class="form form1" name="email" placeholder="naam@voorbeeld.com" /><br>
        <input required type="password" class="form form2" name="wachtwoord1" placeholder="nieuw wachtwoord"/><br>
        <input required type="password" class="form form3" name="wachtwoord2" placeholder="herhaal nieuw wachtwoord"  /> <br>
        <div>
            <input type="submit" class="submitReset" id="submit"  name="submit" value="Submit &rarr;" />
        </div>
    </form>
</div>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    if(isset($_GET["token"]) && isset($_GET["timestamp"])){
        $token = $_GET["token"];
        $timestamp1 = $_GET["timestamp"];
        $melding = "";
        // zoek in database e-mail en de token uit de link
        // include("../DBconfig.php");
        $email = htmlspecialchars($_POST["email"]);
        $wachtwoord = htmlspecialchars($_POST["wachtwoord1"]);
        $wachtwoordHash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        try {
            $sql = "SELECT * FROM personeel WHERE email_personeel = ? AND token = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($email,$token));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // hier controleren we of de link verlopen is.
            if($result) {
                $timestamp2 = new DateTime("now");
                $timestamp2 = $timestamp2->getTimestamp();
                $dif = $timestamp2 - $timestamp1;
                // als de link geldig is slaan we het nieuwe wachtwoord op.
                if(($timestamp2 - $timestamp1) < 43200){
                    $query = "UPDATE personeel SET `wwhash` = ? WHERE `email_personeel` = ?";
                    $stmt = $pdo->prepare($query);
                    $stmt = $stmt->execute(array($wachtwoordHash, $email));
                    if($stmt) {
                        echo "<script>alert('Uw wachtwoord is reset.'); 
            location.href='../login.php';</script>";
                    }
                }else{
                    echo "<script>alert('Link is verlopen.'); 
          location.href='../login.php';</script>";
                }
            }
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
