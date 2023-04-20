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
        
        <div class="log">
            <i class="fa fa-solid fa-user fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href=".\Data\login.php"> Login</a></span>
        </div>
    </header>

    <content>
        <div class="currentPage">
            Contact
        </div>

        <div class="NavMenu">
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="menuHomepage"><a href="/index.php"> Homepage</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navCellencomplex"><a href="./cellencomplex.php"> Cellencomplex</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #f67b50;"></i><span class="navSpan" id="navNieuws"><a href="./nieuws.php"> Nieuws</a></span><br>
            <i class="fa fa-solid fa-caret-right fa-lg" style="color: #A82810;"></i><span class="navSpan" id="navContact"><a href="./contact.php"> <u>Contact</u></a></span>
        </div>

        <div class="c-content-1">
            <p>Telefoonnummer: 06 12345678</p>
            <p>Email: HoornHack@info.nl</p>
            <p>Adres: Noordelijk Halfrond 10, 2801 DE Gouda</p>
        </div>

        <div class="c-content-2">
            <span style="font-size: 2.8vh;"><B>Bezoektijden "HoornHack":</B></span><br>
            Ma: Gesloten.<br>
            Di: Gesloten.<br>
            Wo: 12:00 - 16:00.<br>
            Do: Gesloten.<br>
            Vr: 12:00 - 16:00.<br>
            Za: 12:00 - 16:00.<br>
            Zo: Gesloten.<br>
            <span style="font-size: 1.5vh;">Afspraak verplicht.</span>

        </div>

        <div class="img5"></div>

        <div class="afspraak">
            <span> <a href="./Data/afspraak.php"> Klik hier om een afspraak te maken.</a></span>
        </div>
    </content>

    <script>
        $(".log").click(function() {
            location.replace("./Data/login.php")
        })

        $(".afspraak").click(function() {
            location.replace("./Data/afspraak.php")
        })
    </script>
</body>
</html>