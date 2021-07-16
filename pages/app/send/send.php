<?php

//protecting page from unauthorised users
session_start();
if(!(isset($_SESSION['logged_in_user']))){
    header('Location: ../../home/');
    exit();
}else{
    $business = $_SESSION['logged_in_user'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script defer src="./app.js"></script>
    <title>Send to customers</title>
</head>

<body>
    <nav>
        <div class="logo">BS</div>
        <ul>
            <li>
                <a href="../send/send.php" class="selected">Compose</a>
            </li>
            <li>
                <a href="../view/view.php">Sent SMS</a>
            </li>
        </ul>
        <div class="last">
            <div class="company-name"><?php echo $business; ?></div>
            <div class="button"><a href="../../assets_global/logout.php">Log out</a></div>
        </div>
        
    </nav>
    <div class="banner">Send notifications to your customers anytime and they will get viewed by your customer instantly via SMS!</div>
    <div class="container">
        <div class="search-bar">
            <input type="text" id="search-bar" placeholder="search contacts to select recipients" />
            <div class="suggestions">
            </div>
        </div>
        <div class="selected-contacts">
        </div>
        <form class="button-container" action="send_bulk_sms.php" method="POST">
            <input class="invisible" name="recipients" id="recipients" type="text">
            <div class="message">
                <textarea name="sms" id="sms" cols="30" rows="10" placeholder="Enter you text message here"></textarea>
            </div>
            <button id="send-sms" name="submit" value="submit" type="submit">Send SMS</button>
        </form>
    </div>
</body>

</html>