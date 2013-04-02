<?php //index.php

include 'functions.php';
$session = SessionFactory::getsession();
$session->start();

$session->set('score', 0);
$session->set('correct', array()); 
$session->set('wrong', array());
$session->set('finished','no');
$session->set('num',0);

$quiz = new Quiz($session);// need to allow for specific quizid name as param and pull questions/answers from db allowing for multiple quizzes
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="res/css/style.css" type="text/css" />
    <title>The Web Acronym Test</title>
    <script type="text/javascript" src="res/js/start.js"></script>
</head>
<body id="splash">
    <div id="wrapper">
        <div id="intro">
            <h1>Take the test and see how well you know your web acronyms</h1>
            <p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next acronym.</p>
            <p>There are 20 acronyms, so let's get cracking! You'll get your score at the end of the test. It's just like facebook (honest!).</p>
            <div id="leaders-score">
                <h2>Top 10 Scorers</h2>
                <?php
                echo $quiz->showLeaders(Config::$leadersToShowOnFrontPage, 5);
                ?>
            </div><!-- leaders-score-->
        </div><!--intro-->
        <div id="quiz">
            <h2>Start The Test</h2>
            <p>If featuring on the Score Board is of absolutely no interest to you,</p>
            <form id="jttt" method="post" action="processor.php">
                <p><input type="submit" value="Just Take The Test" /></p>
            </form>
            <form id="questionBox" method="post" action="processor.php">
                <p>If you want to be placed on the 'Top Scorers' list, please enter a username below.</p> 
                <ul>
                    <li><label for="username">Create A Username:</label><br />
                        <input type="text" id="username" name="username" value="Username" />
                        <p id="exp">Username must be between 3 and 10 characters in length</p></li>
                </ul>
                <p><input type="hidden" name="register" value="TRUE" />
                    <input type="submit" id="submit" value="Register And Take The Test" /></p>
            </form> 
            <p id="helper"><?php if ( $session->get('error') ) echo $session->get('error'); ?></p>
        </div><!--quiz-->
    </div><!--wrapper-->
</body>
</html>