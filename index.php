<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>

    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="./src/CSS/main.css">
    <link rel="stylesheet" type="text/css" href="./src/CSS/resize.css">

    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->
    
</head>
<body>
 <div class="background backgroundMain"></div>

    <header>
        <div class="logo"></div>

        <div class="header">
            <i class="fa fa-solid fa-user fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="/src/PHP/Data/login.php"> Login</a></span>
        </div>
    </header>

    <content>
        <div class="motto">
            Zitten om <br> te leren.
        </div>
        
        <span class="currentPage">
            Homepage
        </span>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span id="menuHomepage"><a class="navSpan" href="index.php"> <u>Homepage</u></a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navCellencomplex"><a class="navSpan" href="./src/PHP/cellencomplex.php"> Cellencomplex</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navNieuws"><a class="navSpan" href="./src/PHP/nieuws.php"> Nieuws</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navContact"><a class="navSpan" href="./src/PHP/contact.php"> Contact</a></span>
        </div>
    </content>

    <footer>
        <!-- <div class="code">
            <i class="fa fa-solid fa-code fa-lg" style="color: #f67b50;"></i>
        </div> -->
        <div class="logoFooter logoFooter-home"></div>
    </footer>

    <script>
        // $(".code").click(function() {
        //     location.replace("https://github.com/JulianDotExe/Project-07")
        // })

        $(".header").click(function() {
            window.location.replace("src/PHP/Data/login.php")
        })
    </script>
</body>
</html>