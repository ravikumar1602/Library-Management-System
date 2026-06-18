<?php
include '../config/database.php';
$sql = "SELECT
    issue_books.id,
    students.name,
    books.book_name,
    issue_books.issue_date,
    issue_books.status,
    issue_books.fine
FROM issue_books
JOIN students
    ON issue_books.student_id = students.id
JOIN books
    ON issue_books.book_id = books.id";
$result = mysqli_query($con, $sql);
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Issue Book List</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Issue Book List</h1>
    <table border="1">  
        <tr>
            <th>Student Name</th>
            <th>Book Name</th>
            <th>Issue Date</th>
            <th>Status</th>
            <th>Action</th>
            <th>Fine</th>

        </tr>
        <?php
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";

                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['book_name'] . "</td>";
                        echo "<td>" . $row['issue_date'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";

                        echo "<td>";

                        if($row['status'] == 'issued')
                        {
                            echo "<a href='return-book.php?id=" . $row['id'] . "'>Return</a>";
                        }
                        else
                        {
                            echo "Returned";
                        }

                        echo "</td>";
                        echo "<td>" . $row['fine'] . "</td>";
                        echo "</tr>";
                    }

            }  
            else
                {
                    echo "<tr>
                            <td colspan='6'>No issue book found </td>
                          </tr>";
                } 
        ?>
    </table>
</body>
</html>
