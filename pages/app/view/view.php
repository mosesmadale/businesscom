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
    <title>View all messages</title>
</head>

<body>
    <nav>
        <div class="logo">BS</div>
        <ul>
            <li>
                <a href="../send/send.php">Compose</a>
            </li>
            <li>
                <a href="../view/view.php" class="selected">Sent SMS</a>
            </li>
        </ul>
        <div class="last">
            <div class="company-name"><?php echo $business; ?></div>
            <div class="button"><a href="../../assets_global/logout.php">Log out</a></div>
        </div>
    </nav>
    <div class="banner">View all the SMS you have sent to customers and when!</div>
    <div class="container">
        <div class="search-bar">
            <input type="text" id="search-bar" placeholder="search text messages" />
        </div>
        <div class="message-list">
            <div class="message">
                <div class="header">
                    <div class="type">
                        <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                        <span>Message</span>
                    </div>
                    <div class="date">3 Jul 2021, 3:03</div>
                </div>
                <div class="message-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus unde error enim laboriosam, harum deleniti id assumenda dicta dignissimos quod possimus maiores incidunt exercitationem, ipsam dolor ipsa laudantium quae.
                </div>
            </div>
            <div class="message">
                <div class="header">
                    <div class="type">
                        <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                        <span>Message</span>
                    </div>
                    <div class="date">3 Jul 2021, 3:03</div>
                </div>
                <div class="message-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus unde error enim laboriosam, harum deleniti id assumenda dicta dignissimos quod possimus maiores incidunt exercitationem, ipsam dolor ipsa laudantium quae.
                </div>
            </div>
            <div class="message">
                <div class="header">
                    <div class="type">
                        <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                        <span>Message</span>
                    </div>
                    <div class="date">3 Jul 2021, 3:03</div>
                </div>
                <div class="message-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus unde error enim laboriosam, harum deleniti id assumenda dicta dignissimos quod possimus maiores incidunt exercitationem, ipsam dolor ipsa laudantium quae.
                </div>
            </div>
            <div class="message">
                <div class="header">
                    <div class="type">
                        <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                        <span>Message</span>
                    </div>
                    <div class="date">3 Jul 2021, 3:03</div>
                </div>
                <div class="message-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus unde error enim laboriosam, harum deleniti id assumenda dicta dignissimos quod possimus maiores incidunt exercitationem, ipsam dolor ipsa laudantium quae.
                </div>
            </div>
            <div class="message">
                <div class="header">
                    <div class="type">
                        <img src="../../assets_global/question_answer_black_24dp.svg" alt="message">
                        <span>Message</span>
                    </div>
                    <div class="date">3 Jul 2021, 3:03</div>
                </div>
                <div class="message-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus unde error enim laboriosam, harum deleniti id assumenda dicta dignissimos quod possimus maiores incidunt exercitationem, ipsam dolor ipsa laudantium quae.
                </div>
            </div>
        </div>
    </div>
</body>

</html>