<?php
session_start();
include 'db.php';

$message = '';

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } 
        else 
        {
            $message = "Incorrect password!";
        }
    } 
    else 
    {
        $message = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="form">
        <h2 class="title">Login</h2>
        <form method="post" action="">
            <input type="text" name="email" placeholder="Email" ><br><br>
            <input type="password" name="password" placeholder="Password" ><br><br>

        <div class="btn">
            <button type="submit" name="login" 
            style="padding:10px ; border-radius: 20px; border: none; width:50% ; font-size: 1em;">Login</button>
        </div>

        </form>
        <div class="error" class="class="error" style="text-align: center; background-color: red ; border-radius: 20px; font-weight: bolder; color:white ;">
            <p ><?php echo $message; ?></p>
        </div>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>
</body>
</html>
