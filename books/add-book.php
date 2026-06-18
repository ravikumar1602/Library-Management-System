
<?php
include '../config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $title = $_POST['Book_Title'];
        $author = $_POST['Book_Author'];
        $isbn = $_POST['Book_ISBN'];
        $quantity = $_POST['Book_Quantity'];

        $sql = "INSERT INTO books (book_name, author, isbn, quantity) VALUES ('$title', '$author', '$isbn', '$quantity')";
        if(mysqli_query($con, $sql))
        {
            header("Location: add-book.php?success=1");
            exit();
        }
        else
        {
            echo "Book not added: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    
if(isset($_GET['success']))
    {
        echo "<p>Book added successfully!</p>";
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Add Book</title>
        <link rel='stylesheet' href='../style.css'>
    </head>
    <body>
        <h1>Add Book</h1>
        <form method='post'>
            <div class="form-group">
            <label>Title :</label>
            <input type="text" name="Book_Title" placeholder="Enter book title" required>
            </div>
            <div class="form-group">
            <label>Author :</label>
            <input type="text" name="Book_Author" placeholder="Enter author name" required>
            </div>
            <div class="form-group">
            <label>ISBN :</label>
            <input type="text" name="Book_ISBN" placeholder="Enter ISBN" required>
            </div>
            <div class="form-group">
            <label>Quantity :</label>
            <input type="number" name="Book_Quantity" placeholder="Enter quantity" required min="1">
            </div>
            <div class="form-group">
            <button type='submit'>Add Book</button>
            </div>
        </form>
    </body>
</html>