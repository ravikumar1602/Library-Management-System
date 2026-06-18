<?php
include '../config/database.php';

$id = $_GET['id'];
$sql = "Select * FROM students WHERE id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name = $_POST['Student_Name'];
        $email = $_POST['Student_Email'];
        $age = $_POST['Student_Age'];

        $sql = "UPDATE students SET name='$name', email='$email', age='$age' WHERE id = $id";
        if(mysqli_query($con, $sql))
        {
            header("Location: student-list.php");
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
    <title>Edit Student</title>
    <link rel='stylesheet' href='../style.css'> 
</head>
<body>

    <h1>Edit Student</h1>
        <form method='post' style='margin: auto;'>
            <tr>
                Name :
                <input type="text" name="Student_Name" value="<?php echo $row['name']; ?>">

                <br><br>

                Email :
                <input type="email" name="Student_Email" value="<?php echo $row['email']; ?>">

                <br><br>

                Age :
                <input type="number" name="Student_Age" value="<?php echo $row['age']; ?>">

                <br><br>
                <button type='submit'>Update</button>
            </tr>
        </form>


</body>
</html>