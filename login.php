<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: display.php');
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'matric' => $user['matric'],
                'name' => $user['name'],
                'role' => $user['role']
            ];
            header('Location: display.php');
            exit;
        } else {
            $error = "Invalid username or password, try login again.";
        }
    } else {
        $error = "Invalid username or password, try login again.";
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
        form input, form button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        h2 {
            text-align: center;
        }
        p {
            text-align: center;
        }
        p a {
            color: blue;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <p><a href="register.php">Register</a> here if you have not</p>
</body>
</html>
