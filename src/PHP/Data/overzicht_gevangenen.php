<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/resize.css">
    
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

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
        <div class="back">
            <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
        </div>

        <span class="add"><i class="fa fa-solid fa-plus fa-2x" style="color: #f67b50;"></i></span>

        <div class="dataContain dataCenter">
        <table class="table">
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>ID</th>
                                <th>Naam</th>
                                <th id='optional'>Woonplaats</th>
                                <th id='optional'>Begin-straf</th>
                                <th id='optional'>Eind-straf</th>
                                <th>Cel-nummer</th>
                                <th>Opmerking</th>";
                    break;
                    default:
                        echo "  <th>ID</th>
                                <th>Naam</th>
                                <th id='optional'>Woonplaats</th>
                                <th id='optional'>Begin-straf</th>
                                <th id='optional'>Eind-straf</th>
                                <th>Vleugel-Cel-ID</th>
                                <th>Opmerking</th>
                                <th id='optional'>Actie</th>";
                    break;
                }
            ?>

            
            </tr>
            <?php
            $sql="SELECT * FROM gevangenen LIMIT 5  ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case 'Bewaker':
                        echo "<td>".$row['id_gevangenen']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td id='optional'>".$row['woonplaats']."</td>
                            <td id='optional'>".$row['begin_straf']."</td>
                            <td id='optional'>".$row['eind_straf']."</td>
                            <td>".$row['vleugel_cel_id']."</td>
                            <td>".$row['opmerking']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_gevang.php?id={$row['id_gevangenen']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_gevang.php?id={$row['id_gevangenen']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['id_gevangenen']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td id='optional'>".$row['woonplaats']."</td>
                            <td id='optional'>".$row['begin_straf']."</td>
                            <td id='optional'>".$row['eind_straf']."</td>
                            <td>".$row['vleugel_cel_id']."</td>
                            <td>".$row['opmerking']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_gevang.php?id={$row['id_gevangenen']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_gevang.php?id={$row['id_gevangenen']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    case 'Directeur':
                        echo "<td>".$row['id_gevangenen']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td>".$row['woonplaats']."</td>
                            <td id='optional'>".$row['begin_straf']."</td>
                            <td id='optional'>".$row['eind_straf']."</td>
                            <td>".$row['vleugel_cel_id']."</td>
                            <td>".$row['opmerking']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_gevang.php?id={$row['id_gevangenen']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_gevang.php?id={$row['id_gevangenen']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    default:
                        echo "<td>".$row['id_gevangenen']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td id='optional'>".$row['woonplaats']."</td>
                            <td id='optional'>".$row['begin_straf']."</td>
                            <td id='optional'>".$row['eind_straf']."</td>
                            <td>".$row['vleugel_cel_id']."</td>
                            <td>".$row['opmerking']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_gevang.php?id={$row['id_gevangenen']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_gevang.php?id={$row['id_gevangenen']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
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
        $(".header").click(function() {
            location.replace("./logout.php")
        })

        $(".back").click(function() {
            location.replace("./indexdb.php")
        })

        $(".add").click(function() {
            location.replace("add/gegevens_add_gevang.php")
        })
    </script>
</body>
</html>