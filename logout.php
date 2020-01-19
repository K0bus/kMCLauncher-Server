<?php
    session_start();
    session_destroy();
    if(file_exists('protected/config.json'))
        header('Location: login.php');
    else
        header('Location: register.php');