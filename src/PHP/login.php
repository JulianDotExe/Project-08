<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    
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

    <?php
    require_once("inc/db_conn.php");
    if (isset($_SESSION['uname'])) {
        echo "<script>location.href='overzicht.php'</script>";
    }
    ?>

    <content>
        <div class="container">
                <form action="authorisatie.php" method="POST">
                    <div class="login_text">
                        Inlognaam: <input type="text" name="uname">
                    </div>
                    <div class="login_text">
                        Wachtwoord: <input type="text" name="pwd">
                    </div>
                    </br>
                    <button id="inloggen" type="submit" name="submit" value="login"> Inloggen</button>                    
                    <button id="terug"><a href="/index.html"> Terug</a></button>
                </form>
            </div>
    </content>

    <script>
        $("#terug").click(function() {
            location.replace("/index.html")
        })
        
        $("#inloggen").click(function() {
            location.replace("database.html")
        })
    </script>
</body>
</html>