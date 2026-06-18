<?php
include '../config/database.php';

$id = $_GET['id'];
$sql = "Select * FROM books WHERE id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $title = $_POST['Book_Title'];
        $author = $_POST['Book_Author'];
        $isbn = $_POST['Book_ISBN'];
        $quantity = $_POST['Book_Quantity'];
    
        $sql = "UPDATE books SET book_name='$title', author='$author', isbn='$isbn', quantity='$quantity' WHERE id = $id";
        if(mysqli_query($con, $sql))
        {
            header("Location: book-list.php");
            exit();
        }
        else
        {
            echo "Update failed: " . $sql . "<br>" . mysqli_error($con);
        }
    }


?>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Edit Book</title>
    <link rel='stylesheet' href='../style.css'>
</head>
<body>
    <h1>Edit Book</h1>
    <form method="post">
        <tr>
            Title :
            <input type="text" name="Book_Title" value="<?php echo $row['book_name']; ?>">
            
            <br><br>
            
            Author :
            <input type="text" name="Book_Author" value="<?php echo $row['author']; ?>">
            
            <br><br>

            ISBN :
            <input type="text" name="Book_ISBN" value="<?php echo $row['isbn']; ?>">
            
            <br><br>
            
            Quantity :
            <input type="number" name="Book_Quantity" value="<?php echo $row['quantity']; ?>"required min="1">
            
            <br><br>
            <input type="submit" value="Update Book">   
        </tr>
    </form>
</body>
</html>