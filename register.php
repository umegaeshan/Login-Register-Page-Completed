<?php
include 'db.php';

$message = '';

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // validation

    //check inputs are empty

    if (empty( $username ) || empty( $email) || empty( $password)) 
    {
         $message = "File All Datas !";
        
    }

    // Check if names are invalid

    elseif ( !preg_match("/^[a-zA-Z]+$/",$username)) 
    {
        $message = "Your name is invalid!";
               
    }

    //check email validation

    elseif(!preg_match("/^[a-zA-Z\d._-]+@[a-zA-Z\d_-]+\.[a-zA-Z]{2,}$/", $email))
    {
        $message = "Invalid Email Address!";
        
    }
    //check pasword validation

    elseif (!preg_match("/^.{8,}$/", $password))
    {
        $message = "Passwords has incorect character !";
        
    }

    // Check if email already exists
    elseif (true) 
    {
        $check = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0)
        {
            $message = "Email already registered!";
            
        } 
        else 
        {
            $insert = mysqli_query($connect, "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password_hashed')");
            if($insert)
                {
                    $message = "Registration successful! <a href='index.php'>Login here</a>";
                    header("Location: index.php");
                } 
            else 
                {
                    $message = "Error: " . mysqli_error($connect);
                }
        }
    }
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container">

    <div class="form">

        <h2 class="title">Register</h2>

        <form method="post" action="">
    
            <input type="text" name="username" placeholder="Username" ><br><br>
            <input type="text" name="email" placeholder="Email" ><br><br>
            <input type="password" name="password" placeholder="Password" ><br><br>

            <div class="btn">
                <button type="submit" name="register" class="btn" style=" padding:10px ; border-radius: 20px; border: none; width:50%;font-size: 1em;">Register
            </div>
            
        </form>
        
            <p class="error" style="text-align: center; background-color: red ; border-radius: 20px; font-weight: bolder; color:white;padding: 5px"><?php echo $message; ?></p>
        
        <p>Already have an account? <a href="index.php">Login</a></p>
    </div>
</div>
</body>
</html>
