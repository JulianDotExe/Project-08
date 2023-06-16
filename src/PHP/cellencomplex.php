<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoornHack</title>
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
            Cellencomplex
        </div>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="menuHomepage"><a href="/index.php"> Homepage</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span class="navSpan" id="navCellencomplex"><a href="./cellencomplex.php"> <u>Cellencomplex</u></a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navNieuws"><a href="./nieuws.php"> Nieuws</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navContact"><a href="./contact.php"> Contact</a></span>
        </div>

        <div class="img3"></div>

        <div class="img4"></div>

        <div class="cc-content">
            <span style="font-size: 2.8vh;"><b>Arrestantencomplex "HoornHack"</b></span><br>
            <p>Het arrestantencomplex bestaat uit meerdere faciliteiten, waaronder de A, B en C Vleugels.</p>
            <p>De A vleugel bevat de gevangenen die tijdelijk vast zullen zitten.</p>
            <p>De B vleugel bevat de gevangenen die lang vast zullen zitten.</p>
            <p>De C vleugel bevat de gevangen die erg lang vast zullen zitten.</p>
            <p>In totaal zijn er 23 cellen beschikbaar binnen het complex.</p>
        </div>
    </content>

    <footer>
        <div class="logoFooter logoFooter-cc"></div>
    </footer>

    <script>
        $(".header").click(function() {
            location.replace("./Data/login.php")
        })
    </script>
</body>
</html>