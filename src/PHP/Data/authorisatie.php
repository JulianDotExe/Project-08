<?php
require_once("inc/db_conn.php");

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    session_start();
}else
if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
}else
if($status == PHP_SESSION_ACTIVE){
    //Destroy current and start new one
    session_destroy();
    session_start();
}

$secretKey = "6Lc8OV4lAAAAAHX_J6Z2Nao4cMCSxzK9TowFvo4A";
$responseKey = $_POST['g-recaptcha-response'];
$userIP= $_SERVER['REMOTE_ADDR'];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);

if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->execute();
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM personeel WHERE wachtwoord = :wachtwoord");
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();
    $wachtwoord = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($gebruiker && $wachtwoord && $response->success) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>location.href='failed.php'</script>";
    }
}


?>
