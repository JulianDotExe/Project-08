<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Rollen</title>
</head>
<body>

<?php
    require_once("inc/db_conn.php");
    if (!isset($_SESSION['mail'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='login.php'</script>";
    }
$pageTitle = "Rollen overzicht";

define("RECORDS_PER_PAGE", 100);
//bepaling 'page' voor paginering
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
else {
    $page=1;
}

$start_from = ($page-1) * RECORDS_PER_PAGE;
$objUser = new Gedetineerd($pdo);
$total_rows=$objUser->countUsers();
$total_pages = ceil($total_rows / RECORDS_PER_PAGE);

$objRollen = new Permission($pdo);
$objRechten = new Permission($pdo);

$rollen = $objRollen->getRoles();
$rechten = $objRechten->getPermissions();
?>

    <!-- Het 2e menu, de menu voor het personeel -->
    <div class="worker_menu">
        <div class="terug_blok">
            <a class="terug_knop" href="index.php">
                Terug naar klantenportaal
            </a>
        </div>
        <!-- Tijdelijke 2e menu voor het personeel -->
        <div class="menu_location">
            <?php include("inc/menu.php") ?>
        </div>
        <!-- uitloggen -->
        <div class="uitlog_blok">
            <a href="logout.php">Uitloggen</a>
        </div>
    </div>
<div class="worker_body">
    <div class="worker_content">
        <h2><?php echo $pageTitle ?></h2><br><br>
        <table>
            <tr>
                <?php 
                echo "<th>Rol</th>
                <th>Rechten</th>
                <th>Actie</th>";
                ?>
            </tr>
            <?php
                foreach ($rollen as $rol) {
                    echo "<tr>";
                    echo "<td>{$rol['rol_naam']}</td>";
                    echo "<td>";

                    // Retrieve the permissions for the current role
                    $permissions = $objRechten->getPermissionsForRole($rol['rol_id']);

                    foreach ($permissions as $permission) {
                        echo "{$permission['recht_beschrijving']}<br>";
                    }

                    echo "</td>";
                    echo "<td>
                            <a href='rollen_delete.php?id={$rol['rol_id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                        </td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php 
        echo "<br><a style='text-decoration: none; font-weight: bold;' href='rechten_edit.php' class='btn-edit'><i class='material-icons md-24'>edit</i>Rechten/Rollen aanpassen</a><br>";
        echo "<br><a style='text-decoration: none; font-weight: bold;' href='rollen_toevoegen.php' class='btn-delete'><i class='material-icons md-10'>add</i>Rol aanmaken</a><br>";
        echo "<br><a style='text-decoration: none; font-weight: bold;' href='rechten_toevoegen.php' class='btn-delete'><i class='material-icons md-10'>add</i>Recht aanmaken</a><br>";
        ?>
    </div>
</div>
</body>
</html>