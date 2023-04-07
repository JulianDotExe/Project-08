<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    
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
            <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php

        require_once("inc/db_conn.php");
        if (!isset($_SESSION['uname'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
       <div class="sidebar">
             <button class="btnStyle btn1"> Sorteer - Vleugel </button>
             <button class="btnStyle btn2"> Sorteer - Naam </button>

             <button class="btnStyle btn3"> <a href="overzicht_gevangenen.php"> <span class="underline"> Overzicht - Gevangenen </span></a></button>
             <button class="btnStyle btn4"> <a href="overzicht_personeel.php"> Overzicht - Personeel </a></button>
             <button class="btnStyle btn5"> <a href="overzicht_bezoeken.php"> Overzicht - Bezoeken </a></button>

             <button class="btnStyle btn6"> <a href="add/gegevens_add_gevang.php">Gegevens - Toevoegen </a></button>
             <button class="btnStyle btn7"> Gegevens - Bewerken </button>
        </div>

        <div class="dataContain">
        <table>
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>Gevangenen ID</th>
                                <th>Naam</th>
                                <th>Woonplaats</th>
                                <th>Begin-straf</th>
                                <th>Eind-straf</th>
                                <th>Cel-nummer</th>
                                <th>Vleugel</th>
                                <th>Opmerking</th>";
                    break;
                    default:
                        echo "  <th>Gevangenen ID</th>
                                <th>Naam</th>
                                <th>Woonplaats</th>
                                <th>Begin-straf</th>
                                <th>Eind-straf</th>
                                <th>Cel-nummer</th>
                                <th>Vleugel</th>
                                <th>Opmerking</th>";
                    break;
                }
                ?>
            </tr>
            <?php
            $sql="SELECT * FROM gevangenen";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case 'Bewaker':
                        echo "<td>".$row['gevangenen_id']."</td>
                            <td>".$row['naam']."</td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['gevangenen_id']."</td>
                            <td>".$row['naam']."</td>
                            <td>".$row['woonplaats']."</td>
                            <td>".$row['begin_straf']."</td>
                            <td>".$row['eind_straf']."</td>
                            <td>".$row['cel_nummer']."</td>
                            <td>".$row['vleugel']."</td>
                            <td>".$row['opmerking']."</td>";
                    break;
                    default:
                        echo "<td>".$row['gevangenen_id']."</td>
                            <td>".$row['naam']."</td>
                            <td>".$row['woonplaats']."</td>
                            <td>".$row['begin_straf']."</td>
                            <td>".$row['eind_straf']."</td>
                            <td>".$row['cel_nummer']."</td>
                            <td>".$row['vleugel']."</td>
                            <td>".$row['opmerking']."</td>";
                    break;
                }
                echo "</tr>";
            }
            ?>
        </table>
        </div>

        
    </content>

    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })

        $(".btn3").click(function () {
            location.replace("overzicht_gevangenen.php")
        })

        
        $(".btn4").click(function () {
            location.replace("overzicht_personeel.php")
        })

        
        $(".btn5").click(function () {
            location.replace("overzicht_bezoeken.php")
        })

        $(".btn6").click(function () {
            location.replace("add/gegevens_add_gevang.php")
        })
    </script>
</body>
</html>