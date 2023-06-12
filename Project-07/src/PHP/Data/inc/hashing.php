<?php
$ww = 'adminww';
$pwHash = password_hash($ww, PASSWORD_BCRYPT);

echo $ww . PHP_EOL;
echo $pwHash . PHP_EOL;

if (password_verify($ww, $pwHash)) {
    echo 'Password is valid';
} else {
    echo 'Invalid password';
}
?>