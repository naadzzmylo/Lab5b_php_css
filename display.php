<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        a {
            margin: 0 5px;
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .logout-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-container a:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php
    include 'auth.php';
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if (isset($_GET['delete'])) {
        $matric = $_GET['delete'];
        $conn->query("DELETE FROM users WHERE matric = '$matric'");
        header('Location: display.php');
        exit;
    }
    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    ?>

    <h2>User List</h2>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['matric']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="update.php?matric=<?php echo $row['matric']; ?>">Update</a>
                <a href="display.php?delete=<?php echo $row['matric']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="logout-container">
        <a href="display.php?logout=true">Logout</a>
    </div>
</body>
</html>
