<?php
include '../config/database.php';

$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id = $id";
if(mysqli_query($con, $sql))
{
    header("Location: student-list.php");
    exit();
}
?>