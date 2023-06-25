<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechten</title>

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

    <content>
        <div class="back">
            <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
        </div>
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
    
    $pageTitle = "Rollen en rechten aanpassen";
    
    require_once('../class/permission_class.php');

    // Roles...
    $objRoles = new Permission($pdo);

    // class
    $objRollen = new Permission($pdo);

    // remove obj
    $objPermissions = new Permission($pdo);
    $objCheckPermissions = new Permission($pdo);

    // get rollen
    $rollen = $objRollen->getRoles();
    // var_dump($rollen);

        ?>
        <div class="center">
            <form action="" method="POST" name="permissionsForm">
                <header id="header">
                    <div class="header-content">
                        <div class="header-content-items">
                            <h1 id="titel"><?php echo $pageTitle; ?></h1>
                        </div>
                    </div>
                </header>
                <!-- <input type="hidden" name="action" value="updateRol"> -->

                <div class="recht" id="recht">
                    <!-- Start Roles -->
                    <?php foreach($rollen as $row): ?>
                        <div class="recht-col">
                            <div class="recht-top">
                                <input type="hidden" name="functie_id[]" value="<?= $row['functie_id']; ?>">
                                <input style="padding: 2px 0px; font-size: 18px; width: fit-content; border: none; border-radius: 3px;" type="text" class="rol-title" name="rol_title[]" value="<?= $row['functie_naam']; ?>">
                            </div>
                            <!-- get recht...  -->
                            <?php $recht = $objPermissions->getPermissions();  // recht_id, recht_mod, recht_beschrijving ?>
                            <!-- Check rol_id from rol met recht -->
                            <?php foreach($recht as $row2):  ?>
                                <!-- loop recht rol_id, recht_id -->
                                <?php $check = $objCheckPermissions->checkPermissions($row['functie_id'], $row2['permissie_id']);?>
                                <div class="recht-items">
                                        <!-- Start Roles -->
                                        <input id="<?= $row['functie_naam'].$row2['permissie_id']; ?>" type="checkbox" value="<?= $row2['permissie_id'] ?>" name="<?= $row['functie_naam'] . "[]"; ?>"
                                        <?php foreach ($check as $row3) { echo "checked"; } ?>>
                                        <!-- <span class="checkmark"></span> -->
                                        <label for="<?= $row['functie_naam'].$row2['permissie_id']; ?>"><?= $row2['permissie_desc']; ?></label>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    </br>
                </div>
                <button class="button" type="submit" name="submitButton">Save</button></br>
            </form>
            </br></br>
        </div>
<?php
if (isset($_POST['submitButton'])) {

    $rollen = $objRollen->getRoles();

    foreach ($rollen as $row) {
        $rolnaam = $row['functie_naam'];
        if (isset($_POST[$rolnaam])) {
            $checkboxes = $_POST[$rolnaam];
            $rolId = $row['functie_id'];

            // $rights = new Permission($pdo);
            
            // $rechten = $rights->savePermissions($rolId, $checkboxes);

            if (!empty($rolId)) {
                $rights = new Permission($pdo);
                $rechten = $rights->savePermissions($rolId, $checkboxes);
            } else {
                $errorMessage = "Invalid rolId. Please select a valid role.";
                echo $errorMessage;
            }
        }
    }
    
    $rolIds = $_POST['functie_id'];
    $rolTitles = $_POST['rol_title'];

    // Loop through the submitted data
    for ($i = 0; $i < count($rolIds); $i++) {
        $rolId = $rolIds[$i];
        $rolTitle = $rolTitles[$i];

        // Perform the necessary operations to update the rol_title in the database
        // For example, you can use a prepared statement to update the record
        $updateQry = "UPDATE functie SET functie_naam = :functie_naam WHERE functie_id = :functie_id";
        $updateStmt = $pdo->prepare($updateQry);
        $updateStmt->bindParam(':functie_naam', $rolTitle);
        $updateStmt->bindParam(':functie_id', $rolId);
        $updateStmt->execute();

        // Perform any other operations you need to perform
    }

    echo '<script>
            location.replace("rechten_edit.php");
        </script>';
    exit();

}
?>

<script>
        $(".header").click(function() {
            location.replace("../logout.php")
        })
        
        $(".back").click(function() {
            location.replace("../beheer/permissies.php")
        })
    </script>
</body>
</html>