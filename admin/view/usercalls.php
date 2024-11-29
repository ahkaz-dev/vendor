<?php 
session_start();

if (isset($_SESSION["admin-status"])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Звонки</title>
</head>
<body>
    
</body>
</html>
<?php 
} else { ?>
<p>У вас нет доступа к этой странице</p>
<?php
}  
?>