<?php
include 'config/database.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admins WHERE BINARY username = '$username'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                    // password verify
                if(password_verify($password, $row['password']))
                    {
                        $_SESSION['admin'] = $username;
                        header("Location: dashboard.php");
                        exit();
                    }
                    else
                    {
                        $error = "Invalid username or password";
                    }
            }
            else
            {
                $error = "Invalid username or password";
            }
    }
?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            Username :
            <input type="text" name="username" id="" placeholder="Enter Username">

            <br><br>

            Password : 
            <input type="password" name="password" id="" placeholder="Enter Password">

            <br><br>

            <button type="submit">Login</button>

            <br><br>
            <?php if(!empty($error)) { ?>
                <div class="error">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
        </form> 
    </div>  
</body>
</html>