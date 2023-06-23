<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissies</title>

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
        <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
        <i class="fa fa-solid fa-x"></i>
    </div>
</header>

<content>
    <div class="back">
        <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
    </div>

    <?php
        require_once("../inc/db_conn.php");

        // Prepare the query
        $query = "SELECT functie_id, functie_naam FROM functie";
        $statement = $pdo->prepare($query);

        // Execute the query
        $statement->execute();

        // Fetch the results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="permContain">
        <!-- <span class="menuTitle">Permissies:</span> -->

        <table class="table">
            <tr>
                <th>Functie ID</th>
                <th>Functie Naam</th>
            </tr>
            <?php
            // Loop through each functie row and display data
            foreach ($results as $row) {
                $functieID = $row['functie_id'];
                $functieNaam = $row['functie_naam'];
                echo "<tr>";
                echo "<td>$functieID</td>";
                echo "<td><a href='#' class='functieLink hoverOverzicht' onclick='openModal($functieID)'>$functieNaam</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</content>

<div id="modalBox" class="modal">
    <div class="modal-content larger">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>

<script>
    function openModal(functieID) {
        var modalContent = document.getElementById("modalContent");
        modalContent.innerHTML = "Functie ID: " + functieID;

        var modalBox = document.getElementById("modalBox");
        modalBox.style.display = "block";
    }

    function closeModal() {
        var modalBox = document.getElementById("modalBox");
        modalBox.style.display = "none";
    }

    $(".header").click(function () {
        location.replace("../logout.php");
    });

    $(".back").click(function () {
        location.replace("../beheersmodule.php");
    });

    $(".add").click(function () {
        location.replace("../add/gegevens_add_bezoek.php");
    });
</script>


</body>
</html>
