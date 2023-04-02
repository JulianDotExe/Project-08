<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Login</title>
</head>
<body>

<?php
require_once("inc/db_conn.php");
if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
}
?>

    <!-- Het menu -->
    <div class="menu">
        <a href="index.html"><img class="logo" src="images/hoornhack_logo.png" alt="logo"></a>
        <a class="menu_text" href="index.html">Home</a>
        <a class="menu_text" href="over_ons.html">Over ons</a>
        <a class="menu_text" href="contact.html">Contact</a>
        <a class="menu_text" href="reserveren.html">Reserveren</a>
        <a href="login.php"><img class="account"src="images/account_icon.png" alt="account icon"></a>
    </div>

    <!-- Dit is het login gedeelte, hier word met de post methode en later in dit document word het verwerkt -->
    <div class="login_background">
        <div class="login_blok">
            <p>Inloggen op het Hekkensluiter systeem</p>
            <div class="login_blok2">
                <form action="authorisatie.php" method="POST">
                    <div class="login_text">
                        Inlognaam: <input type="text" name="uname">
                    </div>
                    <div class="login_text">
                        Wachtwoord: <input type="text" name="pwd">
                    </div>
                    </br>
                    <div class="submit_blok">
                        <input type="submit" name="login" value="Inloggen">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>



<!-- Username database: hoornhack -->
<!-- Password database: Wjg5l[-nn(QBbUqV -->
