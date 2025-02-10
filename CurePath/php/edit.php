<?php
include('dbOOP.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $cell_phone = $_POST['cell_phone'];
        $preferred_location = $_POST['preferred_location'];
        $preferred_appointment_date = $_POST['preferred_appointment_date'];

        $update_sql = "UPDATE appointments SET first_name=?, last_name=?, email=?, cell_phone=?, preferred_location=?, preferred_appointment_date=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssi", $first_name, $last_name, $email, $cell_phone, $preferred_location, $preferred_appointment_date, $id);
        $update_stmt->execute();

        header("Location: admin_dashboard.php");
    }

    $conn->close();
}
?>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?= $row['first_name']; ?>" required><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?= $row['last_name']; ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?= $row['email']; ?>" required><br>
    <label>Cell Phone:</label>
    <input type="text" name="cell_phone" value="<?= $row['cell_phone']; ?>" required><br>
    <label>Preferred Location:</label>
    <input type="text" name="preferred_location" value="<?= $row['preferred_location']; ?>" required><br>
    <label>Preferred Appointment Date:</label>
    <input type="date" name="preferred_appointment_date" value="<?= $row['preferred_appointment_date']; ?>" required><br>
    <button type="submit">Save Changes</button>
</form>
