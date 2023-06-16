<?php

if(isset($_POST['submit'])){
$font=realpath('GothicA1-Black.ttf');
$image = imagecreatefromjpeg("certificate.jpeg");
$color =imagecoLoraLLocate($image,19,21,22);
$name =$_POST['uname'];
imagettftext($image, 30, 0, 250, 300 , $color , $font, $name);
imagejpeg($image,"Certificates/good.jpeg");
imagedestroy($image);
echo '<script type="text/JavaScript"> 
            alert("Your Certificate in C/xampp/htdocs/QuizAppW/Certificate");
            </script>';
//echo "Certificate Created";
}
?>

<html>
<body>
<link rel="stylesheet" href="certificate.css" />
<h1>Inter your name you want to put on your certificate</h1>
<form class="cert" method="post">
<input class="text" type="text" name="uname" placeholder="Enter your name"/><br>
<input class="btn" type="submit"name="submit" value="GENERATE">
</form>
</body>
</html>