<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestanden</title>

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

    <?php

    require_once("inc/db_conn.php");
    if (!isset($_SESSION['gebruikersnaam'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
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
        <button id='btnOpenModal'>Upload File <i class="fa fa-solid fa-upload" style="color: #000;"></i></button>
    <?php
        require_once('inc/db_conn.php');
        // Check if a gevangenen ID is provided
        if (isset($_GET['id'])) {
            $gevangenenId = $_GET['id'];

            // Connect to the database
            require_once("inc/db_conn.php");

            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT * FROM files WHERE id_gevangenen = ?");
            $stmt->bindParam(1, $gevangenenId);

            // Execute the statement
            $stmt->execute();

            // Retrieve the uploaded files for the specific gevangenen
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($files) > 0) {
            // Display the uploaded files
            // echo "<span class='menuTitle'>Files for Gevangenen ID $gevangenenId</span>";
            echo "<table class='tableBewijs'>
                        <th>Category</th>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>Description</th>
                        <th>Download</th>
                        <th>Delete</th>
                    <tbody>";

                    foreach ($files as $file) {
                        $fileId = $file['files_id'];
                        $fileName = $file['name'];
                        $fileType = $file['type'];
                        $fileDescription = $file['description'];
                        $fileCategory = $file['category'];
                    
                        echo "<tr>";                        
                        echo "<td>$fileCategory</td>";
                        echo "<td>$fileName</td>";
                        echo "<td>$fileType</td>";
                        echo "<td>$fileDescription</td>";
                    
                        echo "<td><a href='class/download_class.php?id=$fileId'>Download <i class='fa fa-solid fa-download' style='color: #000;'></i></a></td>";
                        echo "<td><a href='class/delete_class.php?file_id=$fileId&id_gevangenen=$gevangenenId'>Delete <i class='fa fa-solid fa-trash' style='color: #000;'></i></a></td>";
                        echo "</tr>";
            }

            echo "</tbody></table>";
            } else {
            echo "<span class='menuTitle'>No uploaded files found.</span>";
            }

            // Display the file upload form
            echo "<div id='uploadModal' class='modal'>";
                echo "<div class='modal-content'>";
                    echo "<span class='close'>&times;</span>";
                        echo "<h2>Upload File</h2><br>";
                        echo "<form id='uploadForm' action='class/upload_class.php' method='post' enctype='multipart/form-data' class='formUpload'>";
                        echo "<input type='hidden' name='id_gevangenen' value='$gevangenenId'>";
                        echo "<input class='formInput' type='file' name='file' required><br><br>";
                            echo "<label for='category'>Select a category:</label>";
                        echo "<select name='category' id='category' class='formSelect' required>";
                            echo "<option value=''>Select a category</option>";
                            echo "<option value='Bewijsmateriaal'>Bewijsmateriaal</option>";
                            echo "<option value='Getuigenverklaring'>Getuigenverklaring</option>";
                            echo "<option value='Gespreksverslagen'>Gespreksverslagen</option>";
                        echo "</select><br><br>";
                        echo "<input class='formInput' type='text' name='description' placeholder='Enter file description' required><br><br>";
                        echo "<input class='formButton' type='submit' value='Upload'>";
                echo "</form></div></div>";
        } else {
            echo "<p>No gevangenen ID provided.</p>";
        }
    ?>
    </div>


</content>

<script>
    $(".header").click(function() {
        location.replace("logout.php")
    });

    $(".back").click(function() {
        location.replace("overzicht_gevangenen.php")
    });

    var modal = document.getElementById("uploadModal");

    // Open
    var btnOpenModal = document.getElementById("btnOpenModal");

    // Close
    var spanClose = document.getElementsByClassName("close")[0];

    btnOpenModal.onclick = function() {
        modal.style.display = "block";
    };

    spanClose.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };


</script>

</body>
</html>





