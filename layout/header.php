<?php
    include 'config/Autoloader.php';
    
    $auth = new App\Session;

    if(!$auth->check()){
        header('location:index');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trademo </title>
    <link rel="shortcut icon" href="public/images/favicon.ico">
    <!-- Style sheet -->
    <link rel="stylesheet" href="public/css/app.css">
    <link href="node_modules/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>