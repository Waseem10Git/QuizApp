<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <link href="login.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<?php 
     session_start(); // 
     if(isset($_POST['login'])){
        include 'config.php';
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $stm ="SELECT *  FROM users WHERE email='$email' AND password='$pass'";
        $result= mysqli_query($conn,$stm);
        $count=mysqli_num_rows($result);
        if($count == 1){
          $_SESSION['email']=$email;
          $_SESSION['password']= $pass;
            header('Location:firstPage.html');
        }
        else {
           // die(" user name and email is invalid ");
            //echo $count;
        }
     }
?>


<div class="wrapper fadeInDown">
    <div id="formContent">



        <form method="POST">
            <input type="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="password" class="fadeIn third" name="password" placeholder="Password">
            <input type="submit" class="fadeIn fourth" value="Sign In" name="login">
        </form>

        <div id="formFooter">
            Don't have an account?<a href="register.php">Sign Up</a>
        </div>
    </div>
</div>
</body>
</html>