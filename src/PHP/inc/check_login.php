<?php
if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
}
?>