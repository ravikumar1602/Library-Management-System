<?php

include 'config/database.php';

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

$sql = "SELECT COUNT(*) as total_students FROM students";
$result = mysqli_query($con, $sql);
$total_students = mysqli_fetch_assoc($result)['total_students'];

$sql = "SELECT COUNT(*) as total_books FROM books";
$result = mysqli_query($con, $sql);
$total_books = mysqli_fetch_assoc($result)['total_books'];

$sql = "SELECT COUNT(*) as total_issue_books FROM issue_books WHERE status = 'issued'";
$result = mysqli_query($con, $sql);
$total_issue_books = mysqli_fetch_assoc($result)['total_issue_books'];

$sql = "SELECT COUNT(*) as total_return_books FROM issue_books WHERE status = 'returned'";
$result = mysqli_query($con, $sql);
$total_return_books = mysqli_fetch_assoc($result)['total_return_books'];

$sql = "SELECT  SUM(fine) as total_fine FROM issue_books";
$result = mysqli_query($con, $sql);
$total_fine = mysqli_fetch_assoc($result)['total_fine'];

?>
<html>
    <head>
        <title>Library Management Dashboard</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'includes/header.php'; ?>

        <h2>Welcome <?php echo $_SESSION['admin']; ?></h2>
        <p>Library Management System</p>

        <h1>Library Management Dashboard</h1>
       
        <div class="card-container">
            <div class="card">
            <h3>Total Students</h3> 
            <h1><?php echo $total_students; ?></h1>
            </div>
            <div class="card">
            <h3>Total Books</h3> 
            <h1><?php echo $total_books; ?></h1>
            </div>
            <div class="card">
            <h3>Total Issue Books</h3>
             <h1><?php echo $total_issue_books; ?></h1>
            </div>
            <div class="card">
            <h3>Total Return Books</h3> 
            <h1><?php echo $total_return_books; ?></h1>
            </div>
            <div class="card">
            <h3 >Total Fine</h3> 
            <h1>₹ <?php echo $total_fine ?? 0; ?></h1>
            </div>
        </div>
        
    </body>
</html>