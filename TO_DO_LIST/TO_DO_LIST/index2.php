<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/5ca74c87ee.js" crossorigin="anonymous"></script>
    <style>
    h2{font-family: 'Dancing Script', cursive;

}
.container {
        display: flex;
        align-items: center; /* Align items vertically */
    }

    
    .icons {
 
    align-items: center;
    border: 4px solid #1e0228;
    padding: 10px;
    border-radius: 10px;
    margin-left: 8px; 
    cursor: pointer;
   
  }

  .task-item {
   
    margin-top:10px;
    
  }
/* 
  .task-item p
  {
    width :23px;
  } */
  #ad{
   
   margin-left:610px;
   
 }


</style>
   </head>
<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <h2 align="center">TO DO LIST  <i class="icons fa-regular fa-rectangle-list fa-fade"></i> </h2>
            
            <div class="container">
              <input type="text" name="list" placeholder="Add task"  style="border: 4px solid #1e0228;"required>
              <button class="icons" type="submit" style=" margin-top: -10px;"> <i class="fas fa-plus"></i></button>
            </div>

        </form>    
    </div>

    <div class="second">
        <?php
        

       // Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "list";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['list'];

    // Insert $task into your database
    $stmt = $conn->prepare("INSERT INTO todo_list (task) VALUES (?)");
    $stmt->bind_param('s', $task); // 's' indicates the parameter is a string
    $stmt->execute();
}

// Fetch tasks from the database and display them
$stmt = $conn->query("SELECT * FROM todo_list");
while($row = $stmt->fetch_assoc()) {
    echo '<div class="task-item">';
    echo $row['task'];

    echo "<a href='delete.php?a={$row['id']}' id='ad'><i class='icons fas fa-trash-alt'></i></a>";
    echo "<a href='edit.php?a={$row['id'] } '><i class='icons fas fa-edit'></i></a>";
    echo '</div>';
}

        ?>
    </div>


</body>
</html>
