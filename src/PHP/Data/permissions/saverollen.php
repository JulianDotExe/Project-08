<?php
    // Roep de Permission class aan en maak een nieuw Permission object aan
    // Zorg ervoor dat je het juiste pad naar de Permission class opgeeft
    require_once("../inc/db_conn.php");

    // Controleer of de gebruiker is ingelogd
    if (!isset($_SESSION['mail'])) {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='../login.php'</script>";
        exit(); // Stop de uitvoering van de rest van de code als de gebruiker niet is ingelogd
    }

    // Controleer of de POST-data is verzonden
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Verkrijg de geselecteerde rollen en rechten uit de POST-data
        $selectedRoles = $_POST['functie_id'];
        $selectedPermissions = $_POST['permissie_id'];

        // Roep de Permission class aan en maak een nieuw Permission object aan
        // Zorg ervoor dat je het juiste pad naar de Permission class opgeeft
        $permission = new Permission($pdo);

        // Loop door de geselecteerde rollen en sla de rechten op
        foreach ($selectedRoles as $roleId) {
            $permission->savePermissions($roleId, $selectedPermissions);
        }

        echo "<script>alert('Rollen succesvol opgeslagen')</script>";
        echo "<script>location.href='rechten_edit.php'</script>";
        exit(); // Stop de uitvoering van de rest van de code na het opslaan van de rollen
    }

    // Als er geen POST-data is verzonden of als de gebruiker niet is ingelogd, doorsturen naar een andere pagina
    echo "<script>alert('Ongeldige aanvraag...')</script>";
    echo "<script>location.href='rechten_edit.php'</script>";
?>
