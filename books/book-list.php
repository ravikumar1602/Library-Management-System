  <?php
include '../config/database.php';

if(isset($_GET['search']) && !empty($_GET['search']))
{
    $search = $_GET['search'];
    $sql = "SELECT * FROM books WHERE book_name LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM books";
}

$result = mysqli_query($con, $sql);

?>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Book List</title>
    <link rel='stylesheet' href='../style.css'>
</head>
<body>
    <h1>Book List</h1>

    <a href="add-book.php" class="add-btn">+ Add Book</a>

    <form method="get" class="search-form">
        <input type="text" name="search" placeholder="Search books name...">
        <button type="submit">Search</button>
    </form>
    <br>
    <table border="1" style="width: 100%;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
        if(mysqli_num_rows($result) > 0) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['book_name'] . "</td>
                                <td>" . $row['author'] . "</td>
                                <td>" . $row['isbn'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>
                                    <a href='edit-book.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='delete-book.php?id=" . $row['id'] . "'>Delete</a>
                                </td>
                            </tr>";
                    }
            }
        else 
            {
                echo   "<tr>
                        <td colspan='6'>No books found</td>
                        </tr>";
            }
        ?>
    </table>
</body>
</html>