<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

             <button class="btnStyle btn3"> Overzicht - Gevangenen </button>
             <button class="btnStyle btn4"> Overzicht - Personeel </button>
             <button class="btnStyle btn5"> Overzicht - Bezoeken </button>

             <button class="btnStyle btn6"> Gegevens - Toevoegen </button>
             <button class="btnStyle btn7"> Gegevens - Bewerken </button>
        </div>

        <div class="dataContain">
        <table>
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>Gedetineerde</th>
                                <th>Cel & vleugel</th>";
                    break;
                    default:
                        echo "  <th>ID</th>
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
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['locatie_vleugel_cel']."</td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['geboortedatum_gedetineerd']."</td>
                            <td>".$row['id_nummer']."</td>
                            <td>".$row['adres_gedetineerd']."</td>
                            <td>".$row['bezittingen']."</td>
                            <td>".$row['datum_opsluiting']."</td>
                            <td>".$row['datum_vrijlating']."</td>
                            <td>".$row['datum_tijd_bezoek']."</td>
                            <td>".$row['aantal_bezoeken']."</td>
                            <td>".$row['locatie_vleugel_cel']." <a href='overplaatsen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a></td>
                            <td>".$row['historie_locatie']."</td>
                            <td>".$row['reden_gedetineerd']."</td>
                            <td>".$row['opmerkingen']."</td>
                            <td>
                                <a href='verwijderen.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    default:
                        echo "<td>".$row['naam_gedetineerd']."</td>
                            <td>".$row['geboortedatum_gedetineerd']."</td>
                            <td>".$row['id_nummer']."</td>
                            <td>".$row['adres_gedetineerd']."</td>
                            <td>".$row['bezittingen']."</td>
                            <td>".$row['datum_opsluiting']."</td>
                            <td>".$row['datum_vrijlating']."</td>
                            <td>".$row['datum_tijd_bezoek']."</td>
                            <td>".$row['aantal_bezoeken']."</td>
                            <td>".$row['locatie_vleugel_cel']." <a href='overplaatsen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a></td>
                            <td>".$row['historie_locatie']."</td>
                            <td>".$row['reden_gedetineerd']."</td>
                            <td>".$row['opmerkingen']."</td>
                            <td>
                                <a href='wijzigen.php?id={$row['id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='verwijderen.php?id={$row['id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
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
    </script>
</body>
</html>