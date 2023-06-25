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
        if (!isset($_SESSION['gebruikersnaam'])) {
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
                require_once("inc/db_conn.php");
                // Get the user's role from a database or session variable
                $uname = $_SESSION['gebruikersnaam'];
                $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
                $stmt->bindParam(':gebruikersnaam', $uname);
                $stmt->execute();
                $userRole = $stmt->fetchColumn();

                switch($userRole) {
                    case '1':
                        echo "   <th id='optional'>Bezoek ID</th>
                                <th>Naam bezoeker</th>
                                <th>Naam gevangenen</th>
                                <th>Tijd</th>
                                <th>Datum</th>"; 
                    break;
                    case '2':
                        echo "  <th id='optional'>Bezoek ID</th>
                                <th>Naam bezoeker</th>
                                <th id='optional'>Email bezoeker</th>
                                <th>Naam gevangenen</th>
                                <th>Reden bezoek</th>
                                <th>Tijd</th>
                                <th>Datum</th>
                                <th id='optional'>Verzoek status</th>
                                <th id='optional'>Verzoek review</th>
                                <th id='optional'>Actie</th>
                                <th id='optional'>Create Date</th>";
                    break;
                    case '3':
                        echo "  <th id='optional'>Bezoek ID</th>
                                <th>Naam bezoeker</th>
                                <th id='optional'>Email bezoeker</th>
                                <th>Naam gevangenen</th>
                                <th>Reden bezoek</th>
                                <th>Tijd</th>
                                <th>Datum</th>
                                <th id='optional'>Verzoek status</th>
                                <th id='optional'>Verzoek review</th>
                                <th id='optional'>Actie</th>
                                <th id='optional'>Create Date</th>";
                    break;
                    case '4':
                        echo "  <th id='optional'>Bezoek ID</th>
                                <th>Naam bezoeker</th>
                                <th id='optional'>Email bezoeker</th>
                                <th>Naam gevangenen</th>
                                <th>Reden bezoek</th>
                                <th>Tijd</th>
                                <th>Datum</th>
                                <th id='optional'>Verzoek status</th>
                                <th id='optional'>Verzoek review</th>
                                <th id='optional'>Actie</th>
                                <th id='optional'>Create Date</th>";
                    break;
                    default: 'Er gaat hier iets mis';
                }
                ?>
            </tr>
            <?php
            
            // Pagination variables
            $results_per_page = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $results_per_page;

            // Fetch total number of records
            $total_records_query = "SELECT COUNT(*) AS total FROM bezoekers";
            $total_records_result = $pdo->query($total_records_query);
            $total_records = $total_records_result->fetch(PDO::FETCH_ASSOC)['total'];

            // Calculate total number of pages
            $total_pages = ceil($total_records / $results_per_page);


            $sql="SELECT * FROM bezoekers LIMIT $offset, $results_per_page";;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case '1':
                        echo "<td>".$row['bezoek_id']."</td>
                            <td>".$row['naam_bezoeker']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td>".$row['tijd']."</td>
                            <td>".$row['datum']."</td>";
                    break;
                    case '2':
                        echo "<td>".$row['bezoek_id']."</td>
                        <td>".$row['naam_bezoeker']."</td>
                        <td>".$row['email_bezoeker']."</td>
                        <td>".$row['naam_gevangenen']."</td>
                        <td>".$row['reden_bezoek']."</td>
                        <td>".$row['tijd']."</td>
                        <td>".$row['datum']."</td>
                        <td>";
                            if ($row['bezoek_verzoek_id'] == 1) {
                                echo "Afwachting";
                            } elseif ($row['bezoek_verzoek_id'] == 2) {
                                echo "Geaccepteerd";
                            } elseif ($row['bezoek_verzoek_id'] == 3) {
                                echo "Afgewezen";
                            }
                        echo "</td>
                        <td>
                            <a href='reqreview.php?id={$row['bezoek_id']}&email_bezoeker={$row['email_bezoeker']}' class='hoverOverzicht'><i>Review</i></a>
                        </td>
                        <td>
                            <a href='edit/gegevens_edit_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Edit</i></a>
                            <a href='delete/gegevens_del_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Delete</i></a>
                        </td>
                        <td>".$row['create_date']."</td>";
                    break;
                    case '3':
                        echo "<td>".$row['bezoek_id']."</td>
                            <td>".$row['naam_bezoeker']."</td>
                            <td>".$row['email_bezoeker']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td>".$row['reden_bezoek']."</td>
                            <td>".$row['tijd']."</td>
                            <td>".$row['datum']."</td>
                            <td>";
                                if ($row['bezoek_verzoek_id'] == 1) {
                                    echo "Afwachting";
                                } elseif ($row['bezoek_verzoek_id'] == 2) {
                                    echo "Geaccepteerd";
                                } elseif ($row['bezoek_verzoek_id'] == 3) {
                                    echo "Afgewezen";
                                }
                            echo "</td>
                            <td>
                                <a href='reqreview.php?id={$row['bezoek_id']}&email_bezoeker={$row['email_bezoeker']}' class='hoverOverzicht'><i>Review</i></a>
                            </td>
                            <td>
                                <a href='edit/gegevens_edit_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Edit</i></a>
                                <a href='delete/gegevens_del_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Delete</i></a>
                            </td>
                            <td>".$row['create_date']."</td>";
                    break;
                    case '2':
                        echo "<td>".$row['bezoek_id']."</td>
                        <td>".$row['naam_bezoeker']."</td>
                        <td id='optional'>".$row['email_bezoeker']."</td>
                        <td>".$row['naam_gevangenen']."</td>
                        <td>".$row['reden_bezoek']."</td>
                        <td>".$row['tijd']."</td>
                        <td>".$row['datum']."</td>
                        <td>";
                            if ($row['bezoek_verzoek_id'] == 1) {
                                echo "Afwachting";
                            } elseif ($row['bezoek_verzoek_id'] == 2) {
                                echo "Geaccepteerd";
                            } elseif ($row['bezoek_verzoek_id'] == 3) {
                                echo "Afgewezen";
                            }
                        echo "</td>
                        <td>
                            <a href='reqreview.php?id={$row['bezoek_id']}&email_bezoeker={$row['email_bezoeker']}' class='hoverOverzicht'><i>Review</i></a>
                        </td>
                        <td>
                            <a href='edit/gegevens_edit_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Edit</i></a>
                            <a href='delete/gegevens_del_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Delete</i></a>
                        </td>
                        <td>".$row['create_date']."</td>";
                    break;
                    case '4':
                        echo "<td id='optional'>".$row['bezoek_id']."</td>
                            <td>".$row['naam_bezoeker']."</td>
                            <td id='optional'>".$row['email_bezoeker']."</td>
                            <td>".$row['naam_gevangenen']."</td>
                            <td>".$row['reden_bezoek']."</td>
                            <td>".$row['tijd']."</td>
                            <td>".$row['datum']."</td>
                            <td id='optional'>";
                                if ($row['bezoek_verzoek_id'] == 1) {
                                    echo "Afwachting";
                                } elseif ($row['bezoek_verzoek_id'] == 2) {
                                    echo "Geaccepteerd";
                                } elseif ($row['bezoek_verzoek_id'] == 3) {
                                    echo "Afgewezen";
                                }
                            echo "</td>
                            <td id='optional'>
                                <a href='reqreview.php?id={$row['bezoek_id']}&email_bezoeker={$row['email_bezoeker']}' class='hoverOverzicht'><i>Review</i></a>
                            </td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Edit</i></a>
                                <a href='delete/gegevens_del_bezoek.php?id={$row['bezoek_id']}' class='hoverOverzicht'><i>Delete</i></a>
                            </td>
                            <td id='optional'>".$row['create_date']."</td>";
                            

                    break;
                    default: 
                            echo 'Er gaat iets mis hier';
                }
                echo "</tr>";
            }

                // Display pagination links
                echo "<div class='pagination'>";
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<a href='?page=$page' " . ($page == $current_page ? "class='active'" : "") . ">$page</a>";
                }
                echo "</div>";
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
            location.replace("add/gegevens_add_bezoek.php")
        })
    </script>
</body>
</html>
<!-- <i class='fa fa-solid fa-thumbs-up'></i> -->
<!-- <i class='fa fa-solid fa-thumbs-down'></i> -->