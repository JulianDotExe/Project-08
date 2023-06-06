<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>

    <link rel="stylesheet" type="text/css" href="./src/CSS/main.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->
    
</head>
<body>
 <div class="background backgroundMain"></div>

    <header>
        <div class="logo"></div>

        <div class="log">
            <i class="fa fa-solid fa-user fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="/src/PHP/Data/login.php"> Login</a></span>
        </div>
    </header>

    <content>
        <div class="motto">
            Zitten om <br> te leren.
        </div>
        
        <div class="currentPage">
            Homepage
        </div>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span class="navSpan" id="menuHomepage"><a href="index.php"> <u>Homepage</u></a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navCellencomplex"><a href="./src/PHP/cellencomplex.php"> Cellencomplex</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navNieuws"><a href="./src/PHP/nieuws.php"> Nieuws</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navContact"><a href="./src/PHP/contact.php"> Contact</a></span>
        </div>
    </content>

    <footer>
        <div class="code">
            <i class="fa fa-solid fa-code fa-lg" style="color: #f67b50;"></i>
        </div>
    </footer>
    <script>
        $(".code").click(function() {
            location.replace("https://github.com/JulianDotExe/Project-07")
        })

        $(".log").click(function() {
            window.location.replace("src/PHP/Data/login.php")
        })
    </script>
</body>
</html>