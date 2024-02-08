<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <h2 align="center">Edit Task</h2>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "list";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = isset($_REQUEST["a"]) ? $_REQUEST["a"] : null;

        if ($id === null) {
            echo "Task ID is not provided!";
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM todo_list WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "Task not found!";
            exit();
        }

        $row = $result->fetch_assoc();
        $task = $row['task'];

        if (isset($_POST["up"])) {
            $task = $_POST['list'];
            $stmt = $conn->prepare("UPDATE todo_list SET task = ? WHERE id = ?");
            $stmt->bind_param('si', $task, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: index2.php");
                exit();
            } else {
                echo "Error updating task: " . $conn->error;
            }
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?a=' . $id; ?>" method="post">
            <input type="text" name="list" value="<?php echo $task; ?>" required>
            <button type="submit" name="up">Update</button>
        </form>
    </div>
</body>
</html>
