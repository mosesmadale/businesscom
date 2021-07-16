<?php



session_start();

if(isset($_SESSION['err-cust-main'])){
    $err = $_SESSION['err-cust-main'];
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
    <script defer src="fetch_businesses.js"></script>
    <title>Register Customer</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <div class="main">BC</div>
            <div class="sub">Business Com</div>
        </div>
        <form action="./mk_customer.php" method="POST">
            <input type="text" name="customer-name" placeholder="Enter your name">
            <select name="business" id="businesses-selects">
                <option value="default">Select Business</option>
                <option value="default">Fetching businesses...</option>
            </select>
            <input type="text" name="phone-number" id="" placeholder="Enter your phone number">
            <button type="submit" name="submit" value="submit">Register</button>
        </form>
        <div class="text"><?php echo $err; ?></div>
    </div>
</body>

</html>