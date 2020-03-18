<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'trademo');

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{

    $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME." ";
    $runStmt = $conn->query($sql) ;

    if( $runStmt){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or  die("Connection to DB failed: " . mysqli_connect_error());
        if($db->connect_error){
            die('Oops ! Something went wrong '.mysqli_connect_error());
        }else{
           
           $sql ="CREATE TABLE IF NOT EXISTS `users` (
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `first_name` varchar(255)  DEFAULT NULL,
            `last_name` varchar(255)  DEFAULT NULL,
            `phone` varchar(255) NULL,
            `email` varchar(255)   NOT NULL,
            `role` enum('admin','company_owner','supervisor','cashier')   NOT NULL DEFAULT 'cashier',
            `password` varchar(255)   NOT NULL,
            `active` tinyint(1)  NULL DEFAULT '0',
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `users_email_unique` (`email`)
          ) ;";

            $sql.="CREATE TABLE IF NOT EXISTS `categories` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `description` VARCHAR(255) NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
                );";

            $sql.="CREATE TABLE IF NOT EXISTS `companies` (
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `tpin` VARCHAR(255) NULL,
            `phone`  VARCHAR(255) NULL,
            `address`  VARCHAR(255) NULL,
            `email`  VARCHAR(255)  NULL,
            `user_id` bigint(20) unsigned NOT NULL,
            `logo`  VARCHAR(255) NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `companies_user_id_foreign` (`user_id`),
            CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
            );";

            $sql.="CREATE TABLE IF NOT EXISTS `company_branches` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `address`  VARCHAR(255) NULL,
                `email`  VARCHAR(255)  NULL,
                `company_id` bigint(20) unsigned NOT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `companies_company_id_foreign` (`company_id`),
                CONSTRAINT `companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
                );";
            $sql.="CREATE TABLE IF NOT EXISTS `products` (
                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `description` VARCHAR(255) NULL,
                `category_id` bigint(20) unsigned NOT NULL,
                `branch_id` bigint(20) unsigned NOT NULL,
                `code`  VARCHAR(255) NULL,
                `sku`  VARCHAR(255) NOT NULL,
                `color`  VARCHAR(255) NULL,
                `image`  VARCHAR(255) NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `products_category_id_foreign` (`category_id`),
                CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE, 
                KEY `products_branch_id_foreign` (`branch_id`),
                CONSTRAINT `products_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `company_branches` (`id`) ON DELETE CASCADE
                );";


                //run all the Queries here
            if (!$db->multi_query($sql)) {
                $response['error'] = true;
                $response['message'] = "Multi query failed: (" . $db->errno . ") " . $db->error; 
               
            }else{
                $response['error'] = false;
                $response['message'] = 'Successfully Installed'; 
            }
        }
    }else{
        die(' Error : Call I.T support');
    }

        //displaying the response in json structure
    if (isset($response)) {
        
        echo json_encode($response);
    }
}
