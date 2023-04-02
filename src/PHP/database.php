<?php
//initialiseren
define('HOST', 'localhost');
define('DATABASE', 'hekkensluiter_p07');
define('USER', 'root');
define('PASSWORD','');
$dbconn='';
//connectie maken
try {
    //methode 1
    //$dbconn_pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";", USER,PASSWORD);
    //methode 2
    //$dbconn_pdo = new PDO("mysql:host=localhost;dbname=transportbedrijf;", "root","H00rnb33ck"); //> werkt
    //methode met charset
    $dbconn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8mb4", USER,PASSWORD);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo $e->getMessage();
    echo "verbinding NIET gemaakt<br>";
}
//functie om de database te sluiten
function fnCloseDb($conn){
    if (!$conn==false)
    {
        $conn = null;
    }
} //end of fnCloseDb

?>