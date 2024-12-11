<?php
include 'auth.php';
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_matric = $_POST['original_matric'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET matric = '$matric', name = '$name', role = '$role' WHERE matric = '$original_matric'";
    if ($conn->query($sql) === TRUE) {
        header('Location: display.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $result = $conn->query("SELECT * FROM users WHERE matric = '$matric'");
    $user = $result->fetch_assoc();
    if (!$user) {
        echo "User not found!";
        exit;
    }
} else {
    echo "No user selected!";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input, form select, form button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        h2 {
            text-align: center;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: blue;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST" action="">
        <input type="hidden" name="original_matric" value="<?php echo htmlspecialchars($user['matric']); ?>">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" required>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        <label>Role:</label>
        <select name="role">
            <option value="student" <?php echo $user['role'] == 'student' ? 'selected' : ''; ?>>Student</option>
            <option value="lecturer" <?php echo $user['role'] == 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
        </select>
        <button type="submit">Update</button>
        <a href="display.php">Cancel</a>
    </form>
</body>
</html>
