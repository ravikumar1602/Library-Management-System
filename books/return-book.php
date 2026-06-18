<?php
include '../config/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM issue_books WHERE id = $id";
$result = mysqli_query($con, $sql);

if($row = mysqli_fetch_assoc($result))
    {
        $book_id = $row['book_id'];

        $issue_date = $row['issue_date'];
        $return_date = date('Y-m-d');

        $issue = new DateTime($issue_date);
        $return = new DateTime($return_date);

        $days = $issue->diff($return)->days;
        
        

        $sql = "UPDATE books SET quantity = quantity + 1 WHERE id = $book_id";
        $result = mysqli_query($con,$sql);

        if($days>15)
            {
                $late_days = $days - 15;
                $fine = $late_days * 5;
            }
            else
            {
                $fine = 0;
            }

        $sql = "UPDATE issue_books SET 
                                        status = 'returned',
                                        return_date = '$return_date',
                                        fine = '$fine'
                                    WHERE id = $id";
        $result = mysqli_query($con,$sql);
        header("Location: issue-book-list.php");
        exit();
    }

?>