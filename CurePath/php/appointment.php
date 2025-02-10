<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurePath</title>
    <link rel="icon" type="image/x-icon" href="../photos/LOGO (2).png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stylePhone.css">
    <link rel="stylesheet" href="../css/easier.css">
    <link rel="stylesheet" href="../css/resizing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
<?php
session_start();
include('dbOOP.php');

class Appointment {
    private $conn;
    private $first_name;
    private $last_name;
    private $date_of_birth;
    private $email;
    private $cell_phone;
    private $gender;
    private $preferred_location;
    private $preferred_appointment_date;

    public function __construct($conn, $data) {
        $this->conn = $conn;
        $this->first_name = mysqli_real_escape_string($conn, $data['first_name']);
        $this->last_name = mysqli_real_escape_string($conn, $data['last_name']);
        $this->date_of_birth = mysqli_real_escape_string($conn, $data['date_of_birth']);
        $this->email = mysqli_real_escape_string($conn, $data['emaiil']);
        $this->cell_phone = mysqli_real_escape_string($conn, $data['cell_phone']);
        $this->gender = mysqli_real_escape_string($conn, $data['gender']);
        $this->preferred_location = mysqli_real_escape_string($conn, $data['preferred_location']);
        $this->preferred_appointment_date = mysqli_real_escape_string($conn, $data['preferred_appointment_date']);
    }

    public function save() {
        $query = "INSERT INTO appointments (first_name, last_name, date_of_birth, emaiil, cell_phone, gender, preferred_location, preferred_appointment_date) 
                  VALUES ('$this->first_name', '$this->last_name', '$this->date_of_birth', '$this->email', '$this->cell_phone', '$this->gender', '$this->preferred_location', '$this->preferred_appointment_date')";

        if (mysqli_query($this->conn, $query)) {
            return true;
        } else {
            return false;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment = new Appointment($conn, $_POST);

    if ($appointment->save()) {
        echo "Takimi u rezervua me sukses!";
        header("Location: appointment.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

    <div class="pc">
        <div class="header0 container-row bg-blue center-items text-center">
            <div class="adresa h0-w color-w"> <a href="https://tinyurl.com/437dfve8" target="_blank"
                    class="color-w">10000, Bulevardi Bill Clinton, Prishtinë</a></div>
            <div class="nr h0-w color-w">+383-44-541-400</div>
            <div class="empty "></div>
            <div class="login h0-w"><a href="LoginOOP.php" class="color-w">Login</a></div>
        </div>
        <div class="header1 container-row bg-gray center-items text-center">
            <div class="logo"><a href="index.php"><img src="../photos/LOGO (2).png" alt=""></a></div>
            <div class="home h-w"><a href="index.php" class="color-b">Home</a></div>
            <div class="about h-w"><a href="About.php" class="color-b">About</a></div>
            <div class="services h-w"><a href="Services.php" class="color-b">Services</a></div>
            <div class="locations h-w color"><a href="Locations.php" class="color-b">Locations</a></div>
            <div class="appointment h-w">
                <button class="bg-green button-head buttons">
                    <a href="appointmentOOP.php" class="color-w ">Make an appointment</a>
                </button>
            </div>
        </div>
        <div class="aabout container-row bg-gray center">
            <h1 class="about-text animate__animated animate__fadeInDown color-g">Make an appointment</h1>
        </div>
        
        <form  method="POST" class="appointmentt">

        <div class="appointment-content container-column container-max bg-blue">
            <div class="appointment-top center">
            
                <div class="child-a container-column">
                        <label for="Name" class="color-w">First Name:</label>
                        <input type="text" name="first_name" id="name">
                    </div>
                    <div class="child-a container-column">
                        <label for="lname" class="color-w">Last Name:</label>
                        <input type="text" name="last_name" id="lname">
                    </div>
                    <div class="child-a container-column">
                        <label for="dateb" class="color-w">Date of Birth:</label>
                        <input type="date" name="date_of_birth" id="date">
                    </div>
                    <div class="child-a container-column">
                        <label for="email" class="color-w">Email:</label>
                        <input type="email" name="emaiil" id="email">
                    </div>
                    <div class="child-a container-column">
                        <label for="" class="color-w">Cell Phone (Use numbers)</label>
                        <input type="number" name="cell_phone" id="number">
                    </div>
                    <div class="child-a container-column">
                        <label for="gender" class="color-w">Gender:</label>
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="child-a container-column">
                        <label for="location" class="color-w">Preferred Location:</label>
                        <select name="preferred_location" id="location">
                            <option value="Prishtinë">Prishtinë</option>
                            <option value="Tirane">Tirane</option>
                            <option value="Peje">Peje</option>
                            <option value="Prizren">Prizren</opt>
                            <option value="Gjakove">Gjakove</option>
                            <option value="Mitrovice">Mitrovice</option>
                        </select>
                    </div>
                    <div class="child-a container-column">
                        <label for="app-date" class="color-w">Preferred appointment date</label>
                        <input type="date" name="preferred_appointment_date" id="app-date">
                    </div>
                </div>
                <div class="appointment-bottom center">
                    <button type="submit" class="submit-btn bg-green color-w butonn buttons">Submit</button><br><br>
                </div>  
            </div>
        </form>
        <div class="footer bg-black container-row color-w container-max">
            <div class="emptyf"></div>
            <div class="footer-main container-column">
                <div class="f-text-top container-row">
                    <div class="twidth t1 center container-column">
                        <img src="../photos/black.png" alt="" class="aa">
                        <p class="f-p">
                            Cure Path, Inc. is a non-profit &copy organization, established in 2025.
                            The
                            organization
                            is
                            governed by a Board of Directors, with representation from each community where our
                            healthcare
                            centers are located.
                        </p>
                    </div>
                    <div class="twidth">
                        <h1>Useful Links</h1>
                        <ul>
                            <li>Privacy Policy</li>
                            <li>Disclaimer</li>
                            <li>Web Accessibility & Statement</li>
                            <li>Contact</li>
                            <li>Sitemap</li>
                        </ul>
                    </div>
                    
                </div>
                <div class="f-text-bottom">
                <p class="fooooter center" style="line-height : 20px;">
                        CurePath Kosovo is a Health Center Program grantee under the relevant laws and regulations of Kosovo, and is considered a public health service provider with protected status under applicable Kosovo laws concerning healthcare and medical malpractice claims.
                        <br>
                        CurePath Kosovo receives funding from the Ministry of Health and other governmental agencies and holds public health service status regarding specific health or health-related claims, including medical malpractice claims, for the organization
                        <br>
                        This project is supported by the Ministry of Health of the Republic of Kosovo under grant number H80CS00427, Health Center Program, for 6.775.973 euro, with a portion of funding coming from nongovernmental sources. The views expressed in this content are those of the author and do not necessarily reflect the official position or policy of the Ministry of Health or any other governmental agency of Kosovo.
                    </p>
                </div>
            </div>
            <div class="emptyf"></div>
        </div>
    </div>
    <div class="phone">
        <div class="p-header0 bg-blue center container-column">
            <div class="p-adresa color-w p-text">10000, Bulevardi Bill Clinton, Prishtinë</div>
            <div class="p-nr color-w p-text">+383-44-541-400</div>

        </div>
        <div class="p-header1 bg-gray container-row center">
            <div class="p-logo"><img src="../photos/LOGO (2).png"></div>
            <div class="p-navbar">
                <nav>
                    <button id="hamburger-button">☰</button>
                </nav>
            </div>
        </div>
        <div class="new-container bg-gray center">
            <ul id="navbar-menu">
                <li><a href="index.php" class="color-b">Home</a></li>
                <li><a href="About.php" class="color-b">About</a></li>
                <li><a href="Services.php" class="color-b">Services</a></li>
                <li><a href="Locations.php" class="color-b">Locations</a></li>
                <li><a href="appointment.php" class="color-b">Appointment</a></li>
                <li><a href="LoginOOP.php" class="color-b">Login</a></li>
            </ul>
        </div>
        <div class="aabout container-row bg-gray center">
            <h1 class="about-text animate__animated animate__fadeInDown color-g">Make an appointment</h1>
        </div>
        <form  method="POST" class="appointmentt">

        <div class="appointment-content container-column container-max bg-blue">
            <div class="appointment-top center">
            
                <div class="child-a container-column">
                        <label for="Name" class="color-w">First Name:</label>
                        <input type="text" name="first_name" id="name">
                    </div>
                    <div class="child-a container-column">
                        <label for="lname" class="color-w">Last Name:</label>
                        <input type="text" name="last_name" id="lname">
                    </div>
                    <div class="child-a container-column">
                        <label for="dateb" class="color-w">Date of Birth:</label>
                        <input type="date" name="date_of_birth" id="date">
                    </div>
                    <div class="child-a container-column">
                        <label for="email" class="color-w">Email:</label>
                        <input type="email" name="emaiil" id="email">
                    </div>
                    <div class="child-a container-column">
                        <label for="" class="color-w">Cell Phone (Use numbers)</label>
                        <input type="number" name="cell_phone" id="number">
                    </div>
                    <div class="child-a container-column">
                        <label for="gender" class="color-w">Gender:</label>
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="child-a container-column">
                        <label for="location" class="color-w">Preferred Location:</label>
                        <select name="preferred_location" id="location">
                            <option value="Prishtinë">Prishtinë</option>
                            <option value="Tirane">Tirane</option>
                            <option value="Peje">Peje</option>
                            <option value="Prizren">Prizren</opt>
                            <option value="Gjakove">Gjakove</option>
                            <option value="Mitrovice">Mitrovice</option>
                        </select>
                    </div>
                    <div class="child-a container-column">
                        <label for="app-date" class="color-w">Preferred appointment date</label>
                        <input type="date" name="preferred_appointment_date" id="app-date">
                    </div>
                </div>
                <div class="appointment-bottom center">
                    <button type="submit" class="submit-btn bg-green color-w butonn buttons">Submit</button><br><br>
                </div>  
            </div>
        </form>
    </div>
    <script src="../js/main.js"></script>
    <script src="https://kit.fontawesome.com/fd47181b1a.js" crossorigin="anonymous"></script>
</body>

</html>
