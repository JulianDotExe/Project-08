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

<content>
    <div class="back">
        <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
    </div>


    <div class="dataContain dataCenter">
        <table class="table">
        <?php
            require_once('inc/db_conn.php');

            try {
             // Pagination variables
            $results_per_page = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $results_per_page;

            // Fetch total number of records
            $total_records_query = "SELECT COUNT(*) AS total FROM cellen";
            $total_records_result = $pdo->query($total_records_query);
            $total_records = $total_records_result->fetch(PDO::FETCH_ASSOC)['total'];

            // Calculate total number of pages
            $total_pages = ceil($total_records / $results_per_page);

            // Fetch vleugel_cel_id and vleugel_cel_bezet from cellen table with pagination
            $query = "SELECT vleugel_cel_id, vleugel_cel_bezet FROM cellen LIMIT $offset, $results_per_page";
            $stmt = $pdo->query($query);

            // Display the results in a table
            echo "<table>";
            echo "<tr>
                    <th>Vleugel-Cel-ID:</th>
                    <th>Vleugel-Cel-Bezet:</th>
                </tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['vleugel_cel_id'] . "</td>";
                echo "<td>" . $row['vleugel_cel_bezet'] . "</td>";
                echo "</tr>";
            }

                echo "</table>";

            // Display pagination links
            echo "<div class='pagination'>";
            for ($page = 1; $page <= $total_pages; $page++) {
                echo "<a href='?page=$page' " . ($page == $current_page ? "class='active'" : "") . ">$page</a>";
            }
            echo "</div>";

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $pdo = null; // Close the connection
        ?>

        </table>
    </div>

</content>

<script>
    $(".header").click(function() {
        location.replace("logout.php")
    })

    $(".back").click(function() {
        location.replace("indexdb.php")
    })
</script>

</body>
</html>