<?php 

session_start();

if(isset($_SESSION['err-login'])){
    $err = $_SESSION['err-login'];
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
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div class="main">BC</div>
            <div class="sub">Business Com</div>
        </div>
        <div class="text">Log in</div>
        <form action="login_auth.php" method="POST">
            <input type="text" name="business-name" placeholder="Enter business name">
            <input type="text" name="code" id="" placeholder="Enter your the code">
            <button type="submit" value="submit" name="submit">Log in</button>
        </form>
        <div class="text"><?php echo $err; ?></div>
    </div>
</body>

</html>