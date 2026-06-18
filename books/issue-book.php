<?php
include '../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];
        $issue_date = $_POST['issue_date'];
        $status = "issued";

        $sql = "SELECT quantity FROM books WHERE id = $book_id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $quantity = $row['quantity'];

        if($quantity > 0)
            {
                $sql = "INSERT INTO issue_books (student_id, book_id, issue_date, status) VALUES ('$student_id', '$book_id', '$issue_date', '$status')";
                if(mysqli_query($con, $sql))
                    {
                        echo "Book issued successfully";
                    }
                else
                    {
                        echo "ERROR: " . $sql . "<br>" . mysqli_error($con);
                    }
                $sql = "UPDATE books SET quantity = quantity - 1 WHERE id = $book_id";
                if(mysqli_query($con, $sql))
                    {
                        header("Location: issue-book-list.php");
                        exit();
                        // echo "Quantity updated successfully";
                    }

                else
                    {
                        echo "Error updating quantity: " . $sql . "<br>" . mysqli_error($con);
                    }
            }
            else
            {
                echo "Book is not available";
            }
    }
?>
<html>
    <head>
        <title>Issue Book</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>

        <h1>Issue Book</h1>

        <form method='post'>
            Student : 
            <select name="student_id">
                <option value="">Select Student</option>
                <?php
                $sql = "SELECT * FROM students";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <br><br>

            Book : 
            <select name="book_id">
                <option value="">Select Book</option>
                <?php
                $sql = "SELECT * FROM books";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['book_name']}</option>";
                }
                ?>
                </select>

            <br><br>
            Issue Date:
            <input type="date" name="issue_date" required>

            <br><br>

            <button type="submit">Issue Book</button>
           
        </form>
    </body>
</html>