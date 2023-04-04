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

if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM personeel WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>location.href='failed.php'</script>";
    }
}
?>
