<?php

session_start();
if(isset($_POST['update'])){
include'config.php';
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$n = $_POST['name'];
$p = $_POST['password'];
if(!empty($p) && empty($n)){
    $up = "UPDATE users SET password='$p' WHERE email='$email'";
    $res = mysqli_query($conn, $up);
    header('Location:login.php');
}
elseif(!empty($n) && empty($p)){
    $up = "UPDATE users SET name='$n' WHERE email='$email'";
    $res = mysqli_query($conn, $up);
    header('Location:login.php');
}
elseif(!empty($p) && !empty($n)){
    $up = "UPDATE users SET name='$n', password='$p' WHERE email='$email'";
    $res = mysqli_query($conn, $up);
    header('Location:login.php');
}
else{
    die("please write your new data");
}


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
            <h2 id="finalScore">Update your information account</h2>
        <form method="POST">
            <input class="update" type="text" name="name" placeholder="NewName">
            <input class="update" type="password" name="password" placeholder="NewPassword">
            <input class="btn" type="submit"  name="update" value="Update">
            <a  class="btn" href="edit.php">Back</a>
        </form>
        </div>
    </div>
    <script src="highscores.js"></script>
</body>
</html>