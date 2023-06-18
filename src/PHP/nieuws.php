<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../img/favicon/site.webmanifest">

    <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../CSS/resize.css">

    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->
    
</head>
<body>
 <div class="background backgroundLight"></div>

    <header>
        <div class="logo"></div>
        
        <div class="header">
            <i class="fa fa-solid fa-user fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="./Data/login.php"> Login</a></span>
        </div>
    </header>

    <content>
        <div class="currentPage">
            Nieuws
        </div>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="menuHomepage"><a class="navSpan" href="/index.php"> Homepage</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navCellencomplex"><a class="navSpan" href="./cellencomplex.php"> Cellencomplex</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span id="navNieuws"><a class="navSpan" href="./nieuws.php"> <u>Nieuws</u></a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navContact"><a class="navSpan" href="./contact.php"> Contact</a></span>
        </div>

        <div class="img1"></div>

        <div class="img2"></div>
        
        <div class="n-content-1">
            <span style="font-size: 2.8vh;"><b>Nieuwe gevangenen.</b></span>
            <p>Afgelopen week zijn er drie nieuwe gevangenen aangekomen in ons
            arrestantencomplex, wij hopen dat
            ze hier zullen zitten om te leren 
            zodat ze weer snel hun leven
            opnieuw kunnen opbouwen.</p>
           <span style="font-size: 1.5vh;">Zaterdag, 18 Maart.</span>
        </div>

        <div class="n-content-2">
            <span style="font-size: 2.8vh;"><b>Alles op zijn tijd.</b></span>
            <p>Volgens een onderzoek komt 95%
            van de gevangenen die weer vrij
            komen, binnen een jaar weer goed
            terecht in de maatschappij met behulp van verschillende organisaties.</p>
           <span style="font-size: 1.5vh;">Donderdag, 16 Maart.</span>
        </div>
    </content>

    <footer>
        <div class="logoFooter logoFooter-news"></div>
    </footer>
    <script>
        $(".header").click(function() {
            location.replace("./Data/login.php")
        })
    </script>
</body>
</html>