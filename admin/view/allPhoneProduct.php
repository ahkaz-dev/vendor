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
        <div style="display:ruby-text">
            <label for="phoneId">Вы работаете с</label>
            <input type="text" id="phoneId" name="phoneId" readonly style="width: max-content;">
        </div>

        <input type="text" placeholder="Марка" name="mark" id="mark" pattern="^[A-Z][A-Za-z -]*$" style="margin-bottom:0px;" maxlength="15" required>
        <span style="opacity:0.75;font-size:15px">Пример: Iphone</span>
        
        <input type="text" placeholder="Модель" name="model" id="model" pattern="^[A-Za-z0-9 -]*$" style="margin-bottom:0px;" maxlength="10" required>
        <span style="opacity:0.75;font-size:15px">Пример: 16 PRO</span>
        
        <input type="text" placeholder="Количество" name="count" id="count" pattern="^\d+$" style="margin-bottom:0px;" maxlength="10" required>
        <span style="opacity:0.75;font-size:15px">Пример: 25</span>

        <input type="text" placeholder="Цена" name="price" id="price" pattern="^\d+$" style="margin-bottom:0px;" maxlength="10" required>
        <span style="opacity:0.75;font-size:15px">Пример: 148990</span>

        <br><br>
        <button type="submit" id="updateButton" name="updateRequest">Обновить</button>
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
            echo '<tr class="list-items">';
            echo '<td>' . htmlspecialchars($row->PhoneId) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneMark) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneModel) . '</td>';
            echo '<td>' . htmlspecialchars($row->CountInStorage) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhonePrice) . '</td>';
            echo '<td>
                      <a href="?phoneId='. htmlspecialchars($row->PhoneId) .'">удалить</a>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $count = trim($_POST['count']);
    $mark = trim($_POST['mark']);
    $phoneId = trim($_POST['phoneId'] ?? '');

    try {
        if (!empty($phoneId)) {
            // Если `phoneId` передан, обновляем существующую запись
            $stmt = $pdo->prepare(
                "UPDATE AllPhoneWare 
                 SET PhoneMark = :PhoneMark, 
                     PhoneModel = :PhoneModel, 
                     CountInStorage = :CountInStorage, 
                     PhonePrice = :PhonePrice 
                 WHERE PhoneId = :PhoneId"
            );
            $stmt->bindParam(':PhoneMark', $mark, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneModel', $model, PDO::PARAM_STR);
            $stmt->bindParam(':CountInStorage', $count, PDO::PARAM_INT);
            $stmt->bindParam(':PhonePrice', $price, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneId', $phoneId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Запись успешно обновлена.";
            } else {
                $message = "Ошибка: не удалось обновить запись.";
            }
        } else {
            // Если `phoneId` отсутствует, добавляем новую запись
            $stmt = $pdo->prepare(
                "INSERT INTO AllPhoneWare (PhoneMark, PhoneModel, CountInStorage, PhonePrice) 
                 VALUES (:PhoneMark, :PhoneModel, :CountInStorage, :PhonePrice)"
            );
            $stmt->bindParam(':PhoneMark', $mark, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneModel', $model, PDO::PARAM_STR);
            $stmt->bindParam(':CountInStorage', $count, PDO::PARAM_INT);
            $stmt->bindParam(':PhonePrice', $price, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $message = "Запись успешно добавлена.";
            } else {
                $message = "Ошибка: не удалось добавить запись.";
            }
        }

        // Перенаправление после успешного выполнения
        echo '<script type="text/javascript">';
        echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/allPhoneProduct.php";';
        echo '</script>';
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['phoneId'])) {
    $Id = $_GET['phoneId'];

    try {
        // Подготовка запроса с использованием параметра
        $stmt = $pdo->prepare("DELETE FROM `AllPhoneWare` WHERE `phoneId` = :phoneId");
        $stmt->bindParam(':phoneId', $Id, PDO::PARAM_INT); // Привязка параметра

        // Выполнение запроса
        if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/allPhoneProduct.php";';
            echo '</script>';
        } else {
            echo "Ошибка при удалении записи.";
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}


require_once '/xampp/htdocs/VENDOR_RABOTA/config/dublicateQuery.php';  // Подключаем файл с запросом на дубликаты

?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleButton');
    const updateButton = document.getElementById('updateButton');

    const slideBlock = document.getElementById('slideBlock');
    const clearButton = document.getElementById('clearButton');
    const submitButton = document.getElementById('submitButton');

    const rows = document.querySelectorAll('tr.list-items');
    const markInput = document.getElementById('mark');
    const modelInput = document.getElementById('model');
    const countInput = document.getElementById('count');
    const priceInput = document.getElementById('price');
    const phoneId = document.getElementById('phoneId');


    toggleButton.addEventListener('click', function () {
        // Переключаем состояние блока
        slideBlock.classList.toggle('active');

        // Если форма активирована через toggleButton, показываем "Submit", скрываем "Update"
        if (slideBlock.classList.contains('active')) {
            submitButton.classList.add('active');
            updateButton.classList.remove('active');
            // Очищаем инпуты от данных
            phoneId.value = "";
            markInput.value = "";
            modelInput.value = "";
            countInput.value = "";
            priceInput.value = "";
        } else {
            // Если форма закрывается, обе кнопки скрыты
            submitButton.classList.remove('active');
            updateButton.classList.remove('active');
        }
    });

    rows.forEach(row => {
        row.addEventListener('click', function () {
            // Открываем форму, если она скрыта
            slideBlock.classList.add('active');

            // Показываем "Update", скрываем "Submit"
            updateButton.classList.add('active');
            submitButton.classList.remove('active');

            // Заполняем данные формы из строки
            const cells = row.querySelectorAll('td');
            phoneId.value = cells[0].textContent.trim();
            markInput.value = cells[1].textContent.trim();
            modelInput.value = cells[2].textContent.trim();
            countInput.value = cells[3].textContent.trim();
            priceInput.value = cells[4].textContent.trim();
        });
    });

    document.addEventListener('click', function (event) {
        const isClickInsideRow = Array.from(rows).some(row => row.contains(event.target));

        // Если клик не внутри формы, кнопки или строки, закрываем форму
        if (
            !slideBlock.contains(event.target) &&
            event.target !== toggleButton &&
            !isClickInsideRow
        ) {
            slideBlock.classList.remove('active');

            // Скрываем обе кнопки
            submitButton.classList.remove('active');
            updateButton.classList.remove('active');
        }
    });



    clearButton.addEventListener('click', function() {
        document.getElementById('slideForm').reset();
    });
});

</script>
</html> 