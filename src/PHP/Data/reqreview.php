<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Request</title>

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
</header>


<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }

    $sql="SELECT * FROM bezoekers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $_GET["id"];
    $series = $pdo->query("SELECT * FROM bezoekers WHERE bezoek_id = $id");
    $row = $series->fetch();
?>


<div class="reviewContain">
    <?php

    ?>
    <form method='POST' action=''>                        
        <input type='submit' name='bezoek_verzoek_id_no' value='Reject' class='return'>        
        <input type='submit' name='bezoek_verzoek_id_yes' value='Accept' class='submit'>
    </form>
</div>

<?php

include('class/reqreview_class.php')


?>
    <script>
        $(".log").click(function() {
            location.replace("logout.php")
        })
    </script>
</body>
</html>    
