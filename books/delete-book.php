<?php
include '../config/database.php';

$id =  $_GET['id'];
$sql = "DELETE FROM books WHERE id = $id";
if(mysqli_query($con, $sql))
    {
        header("Location: book-list.php");
        exit();
    }
    else
        {
            echo "Delete Failed";
        }
?>