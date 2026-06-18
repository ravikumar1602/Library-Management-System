<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Student Registration Form</title>
    <link rel='stylesheet' href='../style.css'>    
</head>
<body>
    <h1>Student Registration Form</h1>
    <?php
    if(isset($_GET['success']))
        {
            echo "<p>Student registered successfully!</p>";
        }
    include '../config/database.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name= $_POST['Student_Name'];
        $email =$_POST['Student_Email'];
        $age = $_POST['Student_Age'];
        if($age >=18 ){
            $age_status = "You are eligible.";
        } else {
            $age_status = "You are not eligible.";
        }
        $sql = "INSERT INTO students (name, email, age) VALUES ('$name', '$email', '$age')";
        if(mysqli_query($con, $sql)) {
            header("Location: student-form.php?success=1");
            exit();
    
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        echo "<br><br>" . $age_status . "<br><br>"; 

    }
        
        
    ?>
    
    <form method='post'>
        <div class="form-group">
            <label>Name :</label>
            <input type="text" name="Student_Name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label>Email :</label>
            <input type="email" name="Student_Email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label>Age :</label>
            <input type="number" name="Student_Age" placeholder="Enter your age" required>
        </div>
        <div class="form-group">
            <button type='submit'>Submit</button>
        </div>
    </form>
</body>
</html> 