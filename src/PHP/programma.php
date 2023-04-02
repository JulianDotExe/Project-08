<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Programma</title>
</head>
<body>
<?php
echo '<h2>Programma Klanten - Orders</h2>';
echo 'u heeft de rechten van ' . $_SESSION['rol'] . PHP_EOL;

?>

</body>
</html>