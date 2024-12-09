<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Звонки</title>
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
        <a href="#" class="breadcrumb-link">Звонки</a>
    </div>  
<button id="toggleButton">Добавить</button>

<div id="slideBlock" class="slide-block">
    <form id="slideForm" method="POST">
        <div style="display:ruby-text">
            <label for="customerId">Вы работаете с</label>
            <input type="text" id="customerId" name="customerId" readonly style="width: max-content;">
        </div>

        <input type="text" placeholder="Имя заказчика" name="customerName" id="customerName" pattern="^[А-ЯЁ][а-яёА-ЯЁ\s-]*$" style="margin-bottom:0px;" maxlength="15" required>
        <span style="opacity:0.75;font-size:15px">Пример: Антон</span>
        
        <input type="text" placeholder="Номер телефона" name="customerPhone" id="customerPhone" pattern="^\d{11}$" style="margin-bottom:0px;" maxlength="11" required>
        <span style="opacity:0.75;font-size:15px">Пример: 79183213311</span>
        
        <br><br>
        <button type="submit" id="updateButton" name="updateRequest">Обновить</button>
        <button type="submit" id="submitButton">Отправить</button>
        <button type="button" id="clearButton">Очистить</button>
    </form>
</div>  
<?php
        try {
            // Пытаемся найти данные в базе
            $stmt = $pdo->prepare("SELECT * FROM Customer ORDER BY CustomerId ASC");
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
                <th>Идентификатор звонка</th>
                <th>Имя заказчика</th>
                <th>Номер телефона</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr class="list-items">';
            echo '<td>' . htmlspecialchars($row->CustomerId) . '</td>';
            echo '<td>' . htmlspecialchars($row->Name) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneNumber) . '</td>';
            echo '<td>
                      <a href="?customerId='. htmlspecialchars($row->CustomerId) .'">удалить</a>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $customerPhone = trim($_POST['customerPhone']);
    $customerName = trim($_POST['customerName']);
    $customerId = trim($_POST['customerId'] ?? '');

    try {
        if (!empty($customerId)) {
            // Если `customerId` передан, обновляем существующую запись
            $stmt = $pdo->prepare(
                "UPDATE Customer
                 SET Name = :Name, PhoneNumber = :PhoneNumber
                 WHERE CustomerId = :CustomerId"
            );
            $stmt->bindParam(':Name', $customerName, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneNumber', $customerPhone, PDO::PARAM_STR);
            $stmt->bindParam(':CustomerId', $customerId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Запись успешно обновлена.";
            } else {
                $message = "Ошибка: не удалось обновить запись. " ;
            }
        } else {
            // Если `customerId` отсутствует, добавляем новую запись
            $stmt = $pdo->prepare(
                "INSERT INTO Customer (Name, PhoneNumber) 
                 VALUES (:name, :phoneNumber)"
            );
            $stmt->bindParam(':name', $customerName, PDO::PARAM_STR);
            $stmt->bindParam(':phoneNumber', $customerPhone, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $message = "Запись успешно добавлена.";
            } else {
                $message = "Ошибка: не удалось добавить запись.";
            }
        }

        // Перенаправление после успешного выполнения
        echo '<script type="text/javascript">';
        echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/usercalls.php";';
        echo '</script>';
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage() . "  id{ $customerId";
    }
}

if (isset($_GET['customerId'])) {
    $Id = $_GET['customerId'];

    try {
        // Подготовка запроса с использованием параметра
        $stmt = $pdo->prepare("DELETE FROM `Customer` WHERE `customerId` = :customerId");
        $stmt->bindParam(':customerId', $Id, PDO::PARAM_INT); // Привязка параметра

        // Выполнение запроса
        if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/usercalls.php";';
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
    const customerNameInput = document.getElementById('customerName');
    const customerPhoneInput = document.getElementById('customerPhone');
    const customerId = document.getElementById('customerId');


    toggleButton.addEventListener('click', function () {
        // Переключаем состояние блока
        slideBlock.classList.toggle('active');

        // Если форма активирована через toggleButton, показываем "Submit", скрываем "Update"
        if (slideBlock.classList.contains('active')) {
            submitButton.classList.add('active');
            updateButton.classList.remove('active');
            // Очищаем инпуты от данных
            customerId.value = "";
            customerNameInput.value = "";
            customerPhoneInput.value = "";
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
            customerId.value = cells[0].textContent.trim();
            customerNameInput.value = cells[1].textContent.trim();
            customerPhoneInput.value = cells[2].textContent.trim();
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

<?php 
    if ($message) {
        if (str_contains($message, "Вы")) {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        } else if (str_contains($message, "Ошибка")) {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        }
    }
?>
</html> 