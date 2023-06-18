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
            <span id="tekstlog"> <a href=".\Data\login.php"> Login</a></span>
        </div>
    </header>

    <content>
        <div class="currentPage">
            Contact
        </div>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="menuHomepage"><a class="navSpan" href="/index.php"> Homepage</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navCellencomplex"><a class="navSpan" href="./cellencomplex.php"> Cellencomplex</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span id="navNieuws"><a class="navSpan" href="./nieuws.php"> Nieuws</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span id="navContact"><a class="navSpan" href="./contact.php"> <u>Contact</u></a></span>
        </div>

        <div class="c-content-1">
            <p>Telefoonnummer: 06 12345678</p>
            <p>Email: HoornHack@info.nl</p>
            <p>Adres: Noordelijk Halfrond 10, 2801 DE Gouda</p>
        </div>

        <div class="c-content-2">
            <p><span class="c-content-2-span" style="font-size: 2.25vh;"><B>Bezoektijden "HoornHack":</B></span></p>
            <p>Ma: Gesloten.</p>
            <p>Di: Gesloten.</p>
            <p>Wo: 12:00 - 16:00.</p>
            <p>Do: Gesloten.</p>
            <p>Vr: 12:00 - 16:00.</p>
            <p>Za: 12:00 - 16:00.</p>
            <p>Zo: Gesloten.</p>
            <span style="font-size: 1.75vh;">Afspraak verplicht.</span>

        </div>

        <div class="img5"></div>

        <div class="afspraak">
            <span> <a href="./Data/afspraak.php"> Klik hier om een afspraak te maken.</a></span>
        </div>
    </content>

    <footer>
        <div class="logoFooter logoFooter-contact"></div>
    </footer>

    <script>
        $(".header").click(function() {
            location.replace("./Data/login.php")
        })

        $(".afspraak").click(function() {
            location.replace("./Data/afspraak.php")
        })
    </script>
</body>
</html>