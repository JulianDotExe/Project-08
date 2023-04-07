<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    
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
    require_once("inc/db_conn.php");
    // if (isset($_SESSION['uname'])) {
    //     echo "<script>location.href='ovezicht.php'</script>";
    // }
    ?>

    <content>
        <div class="container">
                <form action="inc/authorisatie.php" method="POST">
                    <input type="text" id="gn-login" name="uname" placeholder="Gebruikersnaam . . .">
                    <input type="password" id="ww-login" name="pwd" placeholder="Wachtwoord . . . .">
                    <i class="eye fa fa-solid fa-eye" id="togglePassword" style="color: #f67b50;"></i>
                    <div class="g-recaptcha" data-sitekey="6Lc8OV4lAAAAANinYeJoXTeiKFQw-6Jr8J7zrWfS"></div>
                    <button id="inloggen" type="submit" name="submit" value="login"> Inloggen</button>     
                </form>               
                    <button id="terug"><a href="/index.php"> Terug</a></button>
            </div>
    </content>

    <script>
        $("#terug").click(function() {
            location.replace("/index.php")
        })
        
        $("#inloggen").click(function() {
            location.replace("database.php")
        })

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#ww-login');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

<!-- gn = admingn -->
<!-- ww = adminww -->