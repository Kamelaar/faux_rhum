<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 3600');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Maintenance en cours</title>

        <style>
            body {
                width:500px;
                margin:0 auto;
                text-align: center;
                color:grey;
            }
        </style>
    </head>

    <body> 

        <img src="http://localhost/ciblog/assets/images/logo/logo.png" alt="Maintenance">

        <h1><p>Les services du Faux Rhum seront bientôt disponibles</p></h1>

        <img src="http://localhost/ciblog/assets/images/maintenance.gif" alt="Merci pour votre patience">

    </body>
</html>