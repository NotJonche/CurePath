<?php
include('dbOOP.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Cell Phone</th><th>Location</th><th>Appointment Date</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['cell_phone'] . "</td>";
        echo "<td>" . $row['preferred_location'] . "</td>";
        echo "<td>" . $row['preferred_appointment_date'] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No appointments found.";
}

$conn->close();
?>
