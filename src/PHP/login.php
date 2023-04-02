<?php
require_once 'database.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>loginpagina</title>
</head>
<body>
<form action="authorisatie_pdo.php" method="POST" class="frmlogin">
    <label for="fInlog">Inlognaam:</label><input type="text" name="inlognaam" id="fInlog" size="25" placeholder="inlognaam..."><br>
    <label for="fWachtwoord">Wachtwoord:</label><input type="password" id="fWachtwoord" name="wachtwoord" size="25" placeholder="wachtwoord..."><br>
    <input type="submit" name="submit" value="login"><br>
</form>

</body>
</html>

