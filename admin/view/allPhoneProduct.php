<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Телефоны</title>
    <link rel="stylesheet" href="/vendor_rabota/static/style/login.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/view/usercalls.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/view/dashboard.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/component/form-add.css">
</head>
<body style="background-color:white;">
    <!-- Header -->
    <header class="header">
        <a href="http://localhost/vendor_rabota/admin/" class="header-link">Назад</a>
        <a href="http://localhost/vendor_rabota/" class="header-link">Главная</a>
        <a href="#" class="header-link">Помощь</a>
        <a href="#logout" class="header-link" onclick="location.href='http://localhost/vendor_rabota/config/unsetDataSession.php'">Выход</a>
    </header>
      
<!-- Breadcrumbs -->
<div class="breadcrumbs">
        <a href="http://localhost/vendor_rabota/" class="breadcrumb-link">Главная</a>
        <a href="http://localhost/vendor_rabota/admin/" class="breadcrumb-link">Дашборд</a>
        <span>•</span>
        <a href="#" class="breadcrumb-link">Телефоны</a>
    </div>   
    
   
<?php 
session_start();
require_once('/xampp/htdocs/VENDOR_RABOTA/config/db.php');
$message = '';

if (isset($_SESSION["admin-status"])) { 
    if ($_SESSION["admin-status"] == "Модератор") { ?>
<button id="toggleButton">Добавить</button>

<div id="slideBlock" class="slide-block">
    <form id="slideForm" method="POST">
        <input type="text" placeholder="Марка" name="mark">
        <input type="text" placeholder="Модель" name="model">
        <input type="text" placeholder="Количество" name="count">
        <input type="text" placeholder="Цена" name="price">

        <button type="submit" id="submitButton">Отправить</button>
        <button type="button" id="clearButton">Очистить</button>
    </form>
</div>  
<?php
        try {
            // Пытаемся найти данные в базе
            $stmt = $pdo->prepare("SELECT * FROM AllPhoneWare ORDER BY PhoneId ASC");
            $stmt->execute();

        } catch (PDOException $e) {
            $message = "Ошибка: " . $e->getMessage();
        }
    ?>
<?php 
    if ($message) {
        if (str_contains($message, "Вы")) {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        } else if (str_contains($message, "Ошибка")) {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        }
    }
?> 
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Идентификатор телефона</th>
                <th>Марка телефона</th>
                <th>Модель</th>
                <th>Кол-во на складе</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row->PhoneId) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneMark) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneModel) . '</td>';
            echo '<td>' . htmlspecialchars($row->CountInStorage) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhonePrice) . '</td>';
            echo '<td>
                    <button class="action-btn edit-btn" title="Редактировать">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <button class="action-btn delete-btn" title="Удалить">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>      
<?php
    } else if ($_SESSION["admin-status"] == "Пользователь") { ?>
    <?php
    try {
        // Пытаемся найти данные в базе
        $stmt = $pdo->prepare("SELECT * FROM AllPhoneWare ORDER BY PhoneId ASC");
        $stmt->execute();

    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
    ?>
<?php 
    if ($message) {
        if (str_contains($message, "Вы")) {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        } else if (str_contains($message, "Ошибка")) {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        }
    }
?> 
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Идентификатор телефона</th>
                <th>Марка телефона</th>
                <th>Модель</th>
                <th>Кол-во на складе</th>
                <th>Цена</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row->PhoneId) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneMark) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneModel) . '</td>';
            echo '<td>' . htmlspecialchars($row->CountInStorage) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhonePrice) . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php } 
} 
// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $count = trim($_POST['count']);
    $mark = trim($_POST['mark']);
    try {
        // Сохраняем данные в базе
        $stmt = $pdo->prepare("INSERT INTO AllPhoneWare (PhoneMark, PhoneModel, CountInStorage, PhonePrice) VALUES (:PhoneMark, :PhoneModel, :CountInStorage, :PhonePrice)");
        $stmt->bindParam(':PhoneMark', $mark, PDO::PARAM_STR);
        $stmt->bindParam(':PhoneModel', $model, PDO::PARAM_STR);
        $stmt->bindParam(':CountInStorage', $count, PDO::PARAM_STR);
        $stmt->bindParam(':PhonePrice', $price, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $message = "Добавлено";
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/allPhoneProduct.php";';
            echo '</script>';
        } else {
            $message = "Ошибка: Не удалось добавить";
        }
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
}
require_once '/xampp/htdocs/VENDOR_RABOTA/config/dublicateQuery.php';  // Подключаем файл с запросом на дубликаты

?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleButton');
    const slideBlock = document.getElementById('slideBlock');
    const clearButton = document.getElementById('clearButton');
    const submitButton = document.getElementById('submitButton');

    toggleButton.addEventListener('click', function() {
        slideBlock.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!slideBlock.contains(event.target) && event.target !== toggleButton) {
            slideBlock.classList.remove('active');
        }
    });

    clearButton.addEventListener('click', function() {
        document.getElementById('slideForm').reset();
    });

    // submitButton.addEventListener('click', function() {
    //     alert('Form submitted!');
    //     // Here you can add your form submission logic
    // });
});

</script>
</html> 