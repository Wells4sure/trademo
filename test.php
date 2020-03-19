<?php
    include 'config/Autoloader.php';
    
    $user = new App\Session;

    echo $user->check();