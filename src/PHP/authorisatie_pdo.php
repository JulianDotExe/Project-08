<?php
session_start();
require_once 'database.php';  //pdo...
global $dbconn;
if ($_POST['submit']) { // submit is gezet... anders terug naar login.php
    $inlognaam=isset($_POST['inlognaam']) ? $_POST['inlognaam'] : '';
    $wachtwoord=isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';
}
else {
    header('refresh: 1, login.php');
}


//selectquery opbouwen. neem daarin al de inlognaam en wachtwoord mee!;
$query="SELECT gebruiker.id, gebruiker.inlognaam, gebruiker.wachtwoord, rol.naam FROM gebruiker
            INNER JOIN rol ON gebruiker.rol_id=rol.id
          where inlognaam=? and wachtwoord=? ;";
//$resultaat bepalen....
$result = $dbconn->prepare($query);

//bind variable
$result->bindParam(1, $inlognaam);
$result->bindParam(2, $wachtwoord);
//uitvoeren
$result->execute();
//aantal records bepalen....
$aantal=$result->rowCount();
//er mag maar één record uitkomen; immers, maar 1 gebruiker met hetzelfde ww mag voorkomen...

if ($aantal==1){ //let op dubbele ==
    $result->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($result as $row ) {
        $rol=$row['naam'];
    }
    $_SESSION['inlognaam']=$inlognaam;
    $_SESSION['wachtwoord']=$wachtwoord;
    $_SESSION['rol']=$rol;
    $_SESSION['ingelogd']=true;
    header('refresh: 1; url=programma.php');
    exit;
}
else {
    echo 'Helaas, uw inlognaam en/of wachtwoord corresponderen niet met onze gegevens. U wordt doorgestuurd...<br>';
    session_destroy();
    session_unset();
    //sluiten db-connectie
    $dbconn=null;
    header('refresh: 5; url=login.php');
    exit;
}
