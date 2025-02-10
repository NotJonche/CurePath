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
include('dbOOP.php');

class User {
    private $conn;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $email, $password, $role = 'user', $rememberMe = false) {
        $this->username = mysqli_real_escape_string($this->conn, $username);
        $this->email = mysqli_real_escape_string($this->conn, $email);
        $this->password = mysqli_real_escape_string($this->conn, $password);
        $this->role = $role;

        if (empty($this->username) || empty($this->password) || empty($this->email)) {
            echo "All fields are required!";
            exit();
        }
        
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->username, $this->email, $this->password, $this->role);

        if ($stmt->execute()) { 
            $_SESSION['username'] = $this->username;
            $_SESSION['role'] = $this->role;
            $_SESSION['logged_in'] = true;

            // Handle "Remember Me"
            if ($rememberMe) {
                setcookie('username', $this->username, time() + (86400 * 30), "/");
                setcookie('role', $this->role, time() + (86400 * 30), "/");
                setcookie('logged_in', 'true', time() + (86400 * 30), "/");
            }

            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        mysqli_close($this->conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) && $_POST['role'] == 'admin' ? 'admin' : 'user';
    $rememberMe = isset($_POST['remember_me']) ? true : false;

    $user->register($username, $email, $password, $role, $rememberMe);
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
                <a href="LoginOOP.php">Already have an account?</a>
            </div>
        </form> 
    </div>
    
    <script src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/fd47181b1a.js" crossorigin="anonymous"></script>
</body>

</html>
