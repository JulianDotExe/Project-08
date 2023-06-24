<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" href="../../../CSS/main.css">
    <link rel="stylesheet" href="../../../CSS/resize.css">

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
            <span id="tekstlog"> <a href="../logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php
        require_once("../inc/db_conn.php");
        if (!isset($_SESSION['gebruikersnaam'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='../login.php'</script>";
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
                        echo "  <th>Functie ID</th>
                                <th>Functie Naam</th>
                                <th id='optional'Actie</th>"; 
                    break;
                    default:
                        echo "  <th>Functie ID</th>
                                <th>Functie Naam</th>
                                <th id='optional'>Actie</th>"; 
                    break;
                }
                ?>
            </tr>
            <?php
            $sql="SELECT * FROM functie";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case 'Bewaker':
                        echo "<td>".$row['functie_id']."</td>
                            <td>".$row['functie_naam']."</td>
                            <td id='optional'>
                                <a href='../edit/gegevens_edit_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>edit</i></a>
                                <a href='../delete/gegevens_del_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>delete</i></a>
                            </td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['functie_id']."</td>
                            <td>".$row['functie_naam']."</td>
                            <td id='optional'>
                                <a href='../edit/gegevens_edit_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>edit</i></a>
                                <a href='../delete/gegevens_del_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>delete</i></a>
                            </td>";
                    break;
                    default:
                        echo "<td>".$row['functie_id']."</td>
                            <td>".$row['functie_naam']."</td>
                            <td id='optional'>
                                <a href='../edit/gegevens_edit_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>edit</i></a>
                                <a href='../delete/gegevens_del_functie.php?id={$row['functie_id']}' class='hoverOverzicht'><i>delete</i></a>
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
            location.replace("../logout.php")
        })

        $(".back").click(function() {
            location.replace("../beheersmodule.php")
        })

        $(".add").click(function() {
            location.replace("../add/gegevens_add_functie.php")
        })
    </script>
</body>
</html>