<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аксессуары</title>
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

if (isset($_SESSION["admin-status"])) { 
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
        <a href="#" class="breadcrumb-link">Аксессуары</a>
    </div>   
<button id="toggleButton">Добавить</button>

<div id="slideBlock" class="slide-block">
    <form id="slideForm" method="POST">
        <div style="display:ruby-text">
            <label for="accessoryId">Вы работаете с</label>
            <input type="text" id="accessoryId" name="accessoryId" readonly style="width: max-content;">
        </div>

        <input type="text" placeholder="Наименование" name="accessoryName" id="accessoryName" pattern="^[A-Z][A-Za-z -]*$" style="margin-bottom:0px;" maxlength="15" required>
        <span style="opacity:0.75;font-size:15px">Пример: Чехол</span>
        
        <input type="text" placeholder="Описание" name="description" id="description" pattern="^[A-Za-z0-9 -]*$" style="margin-bottom:0px;" maxlength="255" required>
        
        <input type="text" placeholder="Цена" name="price" id="price" pattern="^\d+$" style="margin-bottom:0px;" maxlength="25" required>
        <span style="opacity:0.75;font-size:15px">Пример: 2500</span>

        <input type="text" placeholder="Количество" name="count" id="count" pattern="^\d+$" style="margin-bottom:0px;" maxlength="25" required>
        <span style="opacity:0.75;font-size:15px">Пример: 25</span>



        <br><br>
        <button type="submit" id="updateButton" name="updateRequest">Обновить</button>
        <button type="submit" id="submitButton">Отправить</button>
        <button type="button" id="clearButton">Очистить</button>
    </form>
</div>  
<?php
        try {
            // Пытаемся найти данные в базе
            $stmt = $pdo->prepare("SELECT * FROM Accessories ORDER BY accessoryId ASC");
            $stmt->execute();

        } catch (PDOException $e) {
            $message = "Ошибка: " . $e->getMessage();
        }
    ?>
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Идентификатор</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Кол-во на складе</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr class="list-items">';
            echo '<td>' . htmlspecialchars($row->AccessoryId) . '</td>';
            echo '<td>' . htmlspecialchars($row->AccessoryName) . '</td>';
            echo '<td>' . htmlspecialchars($row->Description) . '</td>';
            echo '<td>' . htmlspecialchars($row->Price) . '</td>';
            echo '<td>' . htmlspecialchars($row->StockCount) . '</td>';
            echo '<td>
                      <a href="?accessoryId='. htmlspecialchars($row->AccessoryId) .'">удалить</a>
                  </td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>      
<?php
    } else if ($_SESSION["admin-status"] == "Пользователь") { ?>
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
        <a href="#" class="breadcrumb-link">Аксессуары</a>
    </div> 
    <?php
    try {
        // Пытаемся найти данные в базе
        $stmt = $pdo->prepare("SELECT * FROM Accessories ORDER BY accessoryId ASC");
        $stmt->execute();

    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
    ?>
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
            <th>Идентификатор</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Кол-во на складе</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row->AccessoryId) . '</td>';
            echo '<td>' . htmlspecialchars($row->AccessoryName) . '</td>';
            echo '<td>' . htmlspecialchars($row->Description) . '</td>';
            echo '<td>' . htmlspecialchars($row->Price) . '</td>';
            echo '<td>' . htmlspecialchars($row->StockCount) . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php
    } 
} else { ?>
    <div class="access-denied">
        <h2>Доступ запрещён</h2>
        <p>У вас нет прав доступа к этому разделу.</p>
        <a href="http://localhost/vendor_rabota/" class="header-link" style="text-decoration: none;">Главная</a>
    </div>
<?php }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $count = trim($_POST['count']);
    $accessoryName = trim($_POST['accessoryName']);
    $accessoryId = trim($_POST['accessoryId'] ?? '');

    try {
        if (!empty($accessoryId)) {
            // Если `accessoryId` передан, обновляем существующую запись
            $stmt = $pdo->prepare(
                "UPDATE Accessories 
                 SET AccessoryName = :AccessoryName, 
                     Description = :Description, 
                     StockCount = :StockCount, 
                     Price = :Price 
                 WHERE accessoryId = :accessoryId"
            );
            $stmt->bindParam(':AccessoryName', $accessoryName, PDO::PARAM_STR);
            $stmt->bindParam(':Description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':StockCount', $count, PDO::PARAM_INT);
            $stmt->bindParam(':Price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':accessoryId', $accessoryId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Запись успешно обновлена.";
            } else {
                $message = "Ошибка: не удалось обновить запись.";
            }
        } else {
            // Если `accessoryId` отсутствует, добавляем новую запись
            $stmt = $pdo->prepare(
                "INSERT INTO Accessories (AccessoryName, Description, Price, StockCount) 
                 VALUES (:AccessoryName, :Description, :Price, :StockCount)"
            );
            $stmt->bindParam(':AccessoryName', $accessoryName, PDO::PARAM_STR);
            $stmt->bindParam(':Description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':StockCount', $count, PDO::PARAM_INT);
            $stmt->bindParam(':Price', $price, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $message = "Запись успешно добавлена.";
            } else {
                $message = "Ошибка: не удалось добавить запись.";
            }
        }

        // Перенаправление после успешного выполнения
        echo '<script type="text/javascript">';
        echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/allAccessories.php";';
        echo '</script>';
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['accessoryId'])) {
    $Id = $_GET['accessoryId'];

    try {
        // Подготовка запроса с использованием параметра
        $stmt = $pdo->prepare("DELETE FROM `Accessories` WHERE `AccessoryId` = :AccessoryId");
        $stmt->bindParam(':AccessoryId', $Id, PDO::PARAM_INT); // Привязка параметра

        // Выполнение запроса
        if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/allAccessories.php";';
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
    const accessoryNameInput = document.getElementById('accessoryName');
    const descriptionInput = document.getElementById('description');
    const countInput = document.getElementById('count');
    const priceInput = document.getElementById('price');
    const accessoryId = document.getElementById('accessoryId');


    toggleButton.addEventListener('click', function () {
        // Переключаем состояние блока
        slideBlock.classList.toggle('active');

        // Если форма активирована через toggleButton, показываем "Submit", скрываем "Update"
        if (slideBlock.classList.contains('active')) {
            submitButton.classList.add('active');
            updateButton.classList.remove('active');
            // Очищаем инпуты от данных
            accessoryId.value = "";
            accessoryNameInput.value = "";
            descriptionInput.value = "";
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
            accessoryId.value = cells[0].textContent.trim();
            accessoryNameInput.value = cells[1].textContent.trim();
            descriptionInput.value = cells[2].textContent.trim();
            priceInput.value = cells[3].textContent.trim();
            countInput.value = cells[4].textContent.trim();
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