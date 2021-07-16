<?php 

session_start();


//obtaining any error messages to give to the user after redirect.
if(isset($_SESSION['err-verifiy-code'])){
    $err = $_SESSION['err-verifiy-code'];
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
    <title>Verify its you!</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div class="main">BC</div>
            <div class="sub">Business Com</div>
        </div>
        <div class="text">We sent a 6-digit code to you via SMS please enter the code here to verify that this phone number is yours.</div>
        <form action="finish.php" method="POST">
            <input type="text" name="code" placeholder="Enter 6-digit code">
            <button type="submit" type="submit" name="submit">Register</button>
            <div class="text"><?php echo $err; ?></div>
        </form>
    </div>
</body>

</html>