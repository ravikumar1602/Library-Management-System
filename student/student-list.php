<?php
include '../config/database.php';

$sql = "SELECT * FROM students";
$result = mysqli_query($con, $sql);

if(isset($_GET['search']) && !empty($_GET['search']))
{
    $search = $_GET['search'];
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%';";
}
else
{
    $sql = "SELECT * FROM students";
}
$result = mysqli_query($con, $sql);

?>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Student List</title>
    <link rel='stylesheet' href='../style.css'>
</head>
<body>  
    <h1>Student List</h1>

    <a href="student-form.php" class="add-btn">+ Add Student</a>

    <form method="get" class = "search-form">
    <input type="text" name="search" placeholder="search students....">
    <button type="submit">Search</button>
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
        <?php
        if(mysqli_num_rows($result) > 0) 
            {
                 while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['age'] . "</td>
                                <td>
                                    <a href='edit.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                                </td>
                            </tr>";
                    }
            }
            else 
            {
                echo   "<tr>
                        <td colspan='5'>No students found</td>
                        </tr>";
            }

        ?>
    </table>
</body>
</html>