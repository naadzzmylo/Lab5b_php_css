<?php
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        echo "Error: " . $conn->error;
    }
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
        h3 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Role:</label>
        <select name="role">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <?php if (isset($success) && $success): ?>
        <h3 style="color: green;">User registered successfully!</h3>
        <h3>Data Entered:</h3>
        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Role</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($matric); ?></td>
                <td><?php echo htmlspecialchars($name); ?></td>
                <td><?php echo htmlspecialchars($role); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>
</html>
