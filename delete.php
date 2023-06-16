<?php
session_start();
if(isset($_POST['Delete'])){
include'config.php';
  $email = $_SESSION['email'];
  
  // sql to delete a record
  $sql = "DELETE FROM users WHERE email='$email'";
  
  if (mysqli_query($conn, $sql)) {
      header('Location:register.php');
    //echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>High Scores</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <div class="container">
        <div id="highScores" class="flex-center flex-column">
            <h1 id="finalScore">Conform to delete account</h1>
        <form method="POST">
            <input class="btn" type="submit"  name="Delete" value="Delete">
            <a  class="btn" href="edit.php">Back</a>
        </form>
        </div>
    </div>
    <script src="highscores.js"></script>
</body>
</html>