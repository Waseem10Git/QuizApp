<?php

    if(isset($_POST['register'])){

        include'config.php';

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email != "") {
            $x ="SELECT * FROM users WHERE email='$email'";
            $r = mysqli_query($conn,$x);
            $num_rows = mysqli_num_rows($r);
            if($num_rows >= 1){
               // header('Location:register.php');
               echo '<script type="text/JavaScript"> 
            alert("Exist Email");
            </script>';
            }else{
                $sql = "INSERT INTO users(name, email, password)
            VALUES('$name', '$email', '$password')";
            $result = mysqli_query($conn, $sql);

            if($result){
                header('Location:login.php');
            }else {
               // die("error not insert");
            }
        }
    }
}


            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register page</title>
<link href="login.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        
        <!-- Icon -->
        <!--<div class="fadeIn first">
            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div>-->
            
        <form action="register.php" method="POST">
            <input type="text" id="login" class="fadeIn first" name="name" placeholder="Username" required="required">
            <input type="email" id="login" class="fadeIn second" name="email" placeholder="Email" required="required">   
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required="required">
            <input type="submit" class="fadeIn fourth" name="register" value="Sign Up">
        </form>

        <div id="formFooter">
           Have an account?<a href="login.php">Sign In</a>
        </div>
    </div>
</div>
</body>
