<?php
$con = mysqli_connect(
    "localhost",
    "root",
    "",
    "library_db"
);
if (!$con) {
    die("Database Connection failed: ");
}
// echo "Database Connection successful.";
?>