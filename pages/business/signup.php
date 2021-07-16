<?php 

session_start();

if(isset($_SESSION['err-main'])){
    $err = $_SESSION['err-main'];
}else{
    $err = '';
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets_global/bc.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div class="main">BC</div>
            <div class="sub">Business Com</div>
        </div>
        <div class="text">Sign Up</div>
        <form action="mk_business.php" method="POST">
            <input type="text" name="business-name" placeholder="Enter business name">
            <input type="text" name="phone-number" id="" placeholder="Enter your phone number">
            <button type="submit" value="submit" name="submit">Register</button>
        </form>
        <div class="text"><?php echo $err; ?></div>
    </div>
</body>

</html>