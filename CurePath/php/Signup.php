<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurePath</title>
    <link rel="icon" type="image/x-icon" href="../photos/LOGO (2).png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <link rel="stylesheet" href="../css/stylePhone.css">
    <link rel="stylesheet" href="../css/easier.css">
    <link rel="stylesheet" href="../css/resizing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <style>
        @media only screen and (max-width: 500px) {
            input {
                width: 200px;
            }
        }       
         @media only screen and (max-width: 410px) {
            input {
                width: 150px;
            }
        }
        @media only screen and (min-width: 500px) {
            input {
                width: 300px;
            }
        }
    </style>
</head>

<body>   
<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    
    if (empty($username) || empty($password)) {
        echo "All fields are required!";
        exit();
    }


    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);
   
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;

    
    if (isset($_POST['remember_me'])) {
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('logged_in', 'true', time() + (86400 * 30), "/");
    }

    header("Location: index.php");
    exit();
}
?>
    <div class="containerLogin container-column">
        <form  method="POST" class="signup">
            <h2>Sign up</h2><br><br>
 
            <div class="userSignup">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username:">
            </div>
            <div class="emailSignup">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email:" required>
            </div>
            <div class="passwordSignup">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password:" >
            </div>

            <div class="options">
                <button type="submit" class="submit-btn">Sign Up</button><br><br>
                <a href="Login.php">Already have an account?</a>
            </div>
        </form> 
    </div>
    
    <script src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/fd47181b1a.js" crossorigin="anonymous"></script>
</body>

</html>
