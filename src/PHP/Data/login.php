<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/resize.css">

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
    ?>

    <content>
        <div class="container">
                <form action="inc/authorisatie.php" method="POST">
                    <input type="text" id="gn-login" name="gebruikersnaam" placeholder="Gebruikersnaam . . .">
                    <input type="password" id="ww-login" name="pwd" placeholder="Wachtwoord . . . .">
                    <i class="eye fa fa-solid fa-eye" id="togglePassword" style="color: #f67b50;"></i>
                    <div class="g-recaptcha" data-sitekey="6Lc8OV4lAAAAANinYeJoXTeiKFQw-6Jr8J7zrWfS"></div>
                    <button id="inloggen" type="submit" name="submit" value="login" class="inlogBtn"> Inloggen</button>     
                </form>               
                    <button id="vergeten" class="inlogBtn"><a href="ww/vergeten.php"> Wachtwoord vergeten</a></button>
                    <button id="terug" class="inlogBtn"><a href="/index.php"> Terug</a></button>
            </div>
    </content>

    <script>
        $("#terug").click(function() {
            location.replace("/index.php")
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