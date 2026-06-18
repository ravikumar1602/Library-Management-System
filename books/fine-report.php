<?php
include '../config/database.php';

$sql = "SELECT students.name,
                books.book_name,
                issue_books.fine
        FROM issue_books
        JOIN students 
        ON issue_books.student_id = students.id
        JOIN books
        ON issue_books.book_id = books.id
        WHERE issue_books.fine > 0 ";
$result = mysqli_query($con, $sql);

?>
<html>
    <head>
        <title>Fine Report</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <h1>Fine Report</h1>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Book Name</th>
                <th>Fine</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['book_name']; ?></td>
                    <td>₹<?php echo $row['fine']; ?></td>
                </tr>
            <?php } ?>
        </table>

    </body>
</html>