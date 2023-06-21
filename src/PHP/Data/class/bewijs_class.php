<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewijs</title>

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

    <?php

    require_once("../inc/db_conn.php");
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }

    // $id = $_GET["id"];
    // $series = $pdo->prepare("SELECT * FROM bewijsmateriaal WHERE id_gevangenen = :id");
    // $series->bindParam(':id', $id);
    // $series->execute();
    // $row = $series->fetch(PDO::FETCH_ASSOC);

    ?>

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
    <?php
        require_once('../inc/db_conn.php');
        // Check if a gevangenen ID is provided
        if (isset($_GET['id'])) {
            $gevangenenId = $_GET['id'];

            // Connect to the database
            require_once("../inc/db_conn.php");

            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT * FROM files WHERE id_gevangenen = ?");
            $stmt->bindParam(1, $gevangenenId);

            // Execute the statement
            $stmt->execute();

            // Retrieve the uploaded files for the specific gevangenen
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($files) > 0) {
            // Display the uploaded files
            echo "<span class='menuTitle'>Files for Gevangenen ID $gevangenenId</span>";
            echo "<table class='table'>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th>File Type</th>
                        <th>Description</th>
                        <th>Download</th>
                    <tbody>";

            foreach ($files as $file) {
                $fileId = $file['files_id'];
                $fileName = $file['name'];
                $fileSize = $file['size'];
                $fileType = $file['type'];
                $fileDesc = $file['description'];


                echo "<tr>
                        <td>$fileName</td>
                        <td>$fileSize</td>
                        <td>$fileType</td>
                        <td>$fileDesc</td>
                        <td><a href='download_class.php?file_id=$fileId'>Download</a></td>
                    </tr>";
            }

            echo "</tbody></table>";
            } else {
            echo "<p>No uploaded files found.</p>";
            }

            // Display the file upload form
            echo "<h2>Upload File:</h2>";
            echo "<form action='upload_class.php' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id_gevangenen' value='$gevangenenId'>";
            echo "<input type='file' name='file' required>";
            echo "<input type='text' name='description' placeholder='Enter file description'>";
            echo "<input type='submit' value='Upload'>";
            echo "</form>";
        } else {
            echo "<p>No gevangenen ID provided.</p>";
        }
    ?>
    </div>

</content>

<script>
    $(".header").click(function() {
        location.replace("../logout.php")
    })

    $(".back").click(function() {
        location.replace("../overzicht_gevangenen.php")
    })
</script>

</body>
</html>