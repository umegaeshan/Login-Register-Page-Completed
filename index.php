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
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Incorrect password!";
        }
    } else {
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
<h2>Login</h2>
<form method="post" action="">
    <input type="text" name="email" placeholder="Email" ><br><br>
    <input type="password" name="password" placeholder="Password" ><br><br>
    <button type="submit" name="login">Login</button>
</form>
<p><?php echo $message; ?></p>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>
