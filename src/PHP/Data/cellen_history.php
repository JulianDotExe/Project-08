<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

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
         
        <div class="header">
            <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php
    require_once("inc/db_conn.php");

    if (isset($_GET['id_gevangenen'])) {
        $id_gevangenen = $_GET['id_gevangenen'];

        $query = "SELECT cb.*, c.vleugel_cel_nr
        FROM cellen_bezetting cb
        INNER JOIN cellen c ON cb.vleugel_cel_id = c.vleugel_cel_id
        WHERE cb.id_gevangenen = :id_gevangenen";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_gevangenen', $id_gevangenen);
        $stmt->execute();
        $cellenHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <content>
        <div class="back">
            <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
        </div>
        <div class="dataContain dataCenter">
            <table class="table">
                <?php if (!empty($cellenHistory)): ?>
                        <thead>
                            <th>Cellen Bezetting ID:</th>
                            <th>Vleugel Cel Nummer:</th>
                            <th>Datum Begin:</th>
                            <th>Datum Eind:</th>
                        </thead>
                    <?php foreach ($cellenHistory as $row): ?>
                        <tr>
                            <td><?php echo $row['cellen_bezetting_id']; ?></td>
                            <td><?php echo $row['vleugel_cel_nr']; ?></td>
                            <td><?php echo $row['datum_begin']; ?></td>
                            <td><?php echo ($row['datum_eind'] === '0000-00-00') ? 'Still in use.' : $row['datum_eind']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <span class='menuTitle'>No cell history available for the gevangenen.</span>
                <?php endif; ?>

            </table>
        </div>


        <script>
            $(".header").click(function() {
                location.replace("./logout.php")
            })

            $(".back").click(function() {
                location.replace("./overzicht_gevangenen.php")
            })
        </script>
    </content>
</body>
</html>
