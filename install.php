
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Style sheet -->
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
    <div id="app">
    <v-app>
        <install :countrie="<?php echo $countries?>"></install>
    </v-app>
    </div>
</body>
<!-- Js Files -->
<script src="public/js/app.js"></script>
</html>