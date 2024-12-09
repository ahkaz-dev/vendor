<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <link rel="stylesheet" href="/vendor_rabota/static/style/login.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/view/usercalls.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/view/dashboard.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/component/form-add.css">
</head>
<body style="background-color:white;">

    
   
<?php 
session_start();
require_once('/xampp/htdocs/VENDOR_RABOTA/config/db.php');
$message = '';

if (isset($_SESSION["admin-status"])) { ?>
 
<?php
    if ($_SESSION["admin-status"] == "Модератор") { ?>
    <!-- Header -->
    <header class="header">
        <a href="http://localhost/vendor_rabota/admin/" class="header-link">Назад</a>
        <a href="http://localhost/vendor_rabota/" class="header-link">Главная</a>
        <a href="http://localhost/vendor_rabota/help/allQuestions.php" class="header-link">Помощь</a>
        <a href="#logout" class="header-link" onclick="location.href='http://localhost/vendor_rabota/config/unsetDataSession.php'">Выход</a>
    </header>
      
<!-- Breadcrumbs -->
<div class="breadcrumbs">
        <a href="http://localhost/vendor_rabota/" class="breadcrumb-link">Главная</a>
        <a href="http://localhost/vendor_rabota/admin/" class="breadcrumb-link">Дашборд</a>
        <span>•</span>
        <a href="#" class="breadcrumb-link">Отзывы</a>
    </div>  
<?php
        try {
            // Пытаемся найти данные в базе
            $stmt = $pdo->prepare("SELECT * FROM UserMessage ORDER BY MessageId ASC");
            $stmt->execute();

        } catch (PDOException $e) {
            $message = "Ошибка: " . $e->getMessage();
        }
    ?>
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Идентификатор отзыва</th>
                <th>От кого</th>
                <th>Номер телефона</th>
                <th>Сообщение</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr class="list-items">';
            echo '<td>' . htmlspecialchars($row->MessageId) . '</td>';
            echo '<td>' . htmlspecialchars($row->ByWho) . '</td>';
            echo '<td>' . htmlspecialchars($row->Phone) . '</td>';
            echo '<td>' . htmlspecialchars($row->MessageText) . '</td>';
            echo '<td>
                      <a href="?customerId='. htmlspecialchars($row->MessageId) .'">удалить</a>
                  </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>      
<?php
    } else if ($_SESSION["admin-status"] == "Пользователь") { ?>
        <div class="access-denied">
            <h2>Доступ запрещён</h2>
            <p>У вас нет прав доступа к этому разделу.</p>
            <a href="http://localhost/vendor_rabota/" class="header-link" style="text-decoration: none;">Главная</a>
        </div>
<?php } 
} else { ?>
    <div class="access-denied">
        <h2>Доступ запрещён</h2>
        <p>У вас нет прав доступа к этому разделу.</p>
        <a href="http://localhost/vendor_rabota/" class="header-link" style="text-decoration: none;">Главная</a>
    </div>
<?php }
if (isset($_GET['customerId'])) {
    $Id = $_GET['customerId'];
    try {
        // Подготовка запроса с использованием параметра
        $stmt = $pdo->prepare("DELETE FROM `UserMessage` WHERE `MessageId` = :MessageId");
        $stmt->bindParam(':MessageId', $Id, PDO::PARAM_INT); // Привязка параметра

        // Выполнение запроса
        if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/message.php";';
            echo '</script>';
        } else {
            echo "Ошибка при удалении записи.";
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>
</body>
</html> 