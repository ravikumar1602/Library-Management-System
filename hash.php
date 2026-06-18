<?php

echo "Admin Hash:<br>";
echo password_hash("123456", PASSWORD_DEFAULT);

echo "<br><br>";

echo "Ravi Hash:<br>";
echo password_hash("1234", PASSWORD_DEFAULT);

?>