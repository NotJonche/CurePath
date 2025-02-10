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
        @media only screen and (min-width: 555px) {
            input {
                width: 350px;
            }
        }
    </style>
</head>

<body>   

<?php
session_start();
include('dbOOP.php');

class UserAuth {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            echo "Please fill in both fields!";
            exit();
        }

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "Invalid username or password!";
            exit();
        }

        $user = $result->fetch_assoc();

        if ($password !== $user['password']) {
            echo "Invalid username or password!";
            exit();
        }

        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; 
        $_SESSION['logged_in'] = true;

        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php"); 
        } else {
            header("Location: index.php"); 
        }
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new UserAuth($conn);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth->login($username, $password);
}
?>



    
    <div class="containerLogin">
        <form class="login-form" action="loginoop.php" method="POST" >
            <p class="loginwb">Welcome to CurePath <br>your guide to the best care!</p>     
             <h2>Login</h2>
            <div class="form-group emailDiv container-column">
                <label for="username">username:</label>
                <input type="username" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group passwordDiv container-column">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button><br><br>
            <a href="SignupOOP.php">Create an account.</a>
        </form>
    </div>
    
    <script src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/fd47181b1a.js" crossorigin="anonymous"></script>
</body>

</html>
