<?php
    include 'config/Autoloader.php';
    
    $user = new app\controller\Session;

    echo $user->user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trademo</title>
    <!-- Style sheet -->
    <link rel="stylesheet" href="public/css/app.css">
    <link href="node_modules/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
</head>