<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учетные записи</title>
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
        <a href="#" class="breadcrumb-link">Учетные записи пользователей</a>
    </div>   
    
   
<?php 
session_start();
require_once('/xampp/htdocs/VENDOR_RABOTA/config/db.php');
$message = '';

if (isset($_SESSION["admin-status"])) { 
    if ($_SESSION["admin-status"] == "Модератор") { ?>
<button id="toggleButton">Добавить</button>

<div id="slideBlock" class="slide-block">
    <form id="slideForm" method="POST" name="addNewAccount">
        <div style="display:ruby-text">
            <label for="accountId">Вы работаете с</label>
            <input type="text" id="accountId" name="accountId" readonly style="width: max-content;">
        </div>

        <input type="text" placeholder="Логин" name="accountName" id="accountName" pattern="^[a-zA-Z][a-zA-Z _\-]{9,19}$" style="margin-bottom:0px;" maxlength="20" required>
        <span style="opacity:0.75;font-size:15px">Буквы, цифры, пробел, подчеркивание, тире (мин. 9 символов)</span>
        
        <input type="text" placeholder="Пароль" name="accountPassword" id="accountPassword" pattern="^[a-zA-Z0-9!_\-\)\(]{8,16}$" style="margin-bottom:0px;" maxlength="16" required>
        <span style="opacity:0.75;font-size:15px">Знаки: !_-)( буквы, цифры</span>

        <input type="text" placeholder="Номер телефона" name="phonenubmer" id="phonenubmer" required pattern="^\d{11}$" maxlength="11"/>
        <span style="opacity:0.75;font-size:15px;">Пример: 79182332322</span><br><br>
        
        <label for="role">Роль:</label>
        <select id="role" name="roles" required>
            <option value="" disabled selected>--- Выберите роль ---</option>
            <option value="Пользователь">Пользователь</option>
            <option value="Модератор">Модератор</option>
        </select>
        
        <br><br>
        <button type="submit" id="updateButton" name="updateRequest">Обновить</button>
        <button type="submit" id="submitButton">Отправить</button>
        <button type="button" id="clearButton">Очистить</button>
    </form>
</div>  
<?php
        try {
            // Пытаемся найти данные в базе
            $stmt = $pdo->prepare("SELECT * FROM useraccount ORDER BY UserId ASC");
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
                <th>Идентификатор учетной записи</th>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Номер телефона</th>
                <th>Статус учетной записи</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            if ($_SESSION["admin-id"] == $row->UserId) {
                echo '<tr class="list-items" style="pointer-events: none; background-color:#999999d4;">';
            } else {
                echo '<tr class="list-items">';
            }
            echo '<td>' . htmlspecialchars($row->UserId) . '</td>';
            echo '<td>' . htmlspecialchars($row->Login) . '</td>';
            echo '<td>' . htmlspecialchars($row->Password) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneNumber) . '</td>';
            echo '<td>' . htmlspecialchars($row->StatusRole) . '</td>';
            echo '<td>
                      <a href="?accountId='. htmlspecialchars($row->UserId) .'">удалить</a>
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
    echo "У вас нет доступа к этой странице!";
    ?>
<?php } 
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $accountPassword = trim($_POST['accountPassword']);
    $accountName = trim($_POST['accountName']);
    $accountPhone = trim($_POST['phonenubmer']);

    $role = $_POST['roles'];

    $accountId = trim($_POST['accountId'] ?? '');

    try {
        if (!empty($accountId)) {
            // Если `accountId` передан, обновляем существующую запись
            $stmt = $pdo->prepare(
                "UPDATE useraccount
                 SET Login = :Login, Password = :Password, PhoneNumber = :PhoneNumber, StatusRole = :StatusRole
                 WHERE userId = :userId"
            );
            $stmt->bindParam(':Login', $accountName, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $accountPassword, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneNumber', $accountPhone, PDO::PARAM_STR);
            $stmt->bindParam(':StatusRole', $role, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $accountId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Запись успешно обновлена.";
            } else {
                $message = "Ошибка: не удалось обновить запись. " ;
            }
        } else {
            // Если `accountId` отсутствует, добавляем новую запись
            $stmt = $pdo->prepare(
                "INSERT INTO useraccount (Login, Password, PhoneNumber, StatusRole) 
                 VALUES (:Login, :Password, :PhoneNumber, :StatusRole)"
            );
            $stmt->bindParam(':Login', $accountName, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $accountPassword, PDO::PARAM_STR);
            $stmt->bindParam(':PhoneNumber', $accountPhone, PDO::PARAM_STR);
            $stmt->bindParam(':StatusRole', $role, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Запись успешно добавлена.";
            } else {
                $message = "Ошибка: не удалось добавить запись.";
            }
        }

        // Перенаправление после успешного выполнения
        echo '<script type="text/javascript">';
        echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/userAccount.php";';
        echo '</script>';
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['accountId'])) {
    $Id = $_GET['accountId'];

    try {
        // Подготовка запроса с использованием параметра
        $stmt = $pdo->prepare("DELETE FROM `useraccount` WHERE `userId` = :userId");
        $stmt->bindParam(':userId', $Id, PDO::PARAM_INT); // Привязка параметра

        // Выполнение запроса
        if ($stmt->execute()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/view/userAccount.php";';
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
    const accountNameInput = document.getElementById('accountName');
    const accountPasswordInput = document.getElementById('accountPassword');
    const phoneInput = document.getElementById('phonenubmer');
    const roleInput = document.getElementById('role');

    const accountId = document.getElementById('accountId');


    toggleButton.addEventListener('click', function () {
        // Переключаем состояние блока
        slideBlock.classList.toggle('active');

        // Если форма активирована через toggleButton, показываем "Submit", скрываем "Update"
        if (slideBlock.classList.contains('active')) {
            submitButton.classList.add('active');
            updateButton.classList.remove('active');
            // Очищаем инпуты от данных
            accountId.value = "";
            accountNameInput.value = "";
            accountPasswordInput.value = "";
            phoneInput.value = "";
            roleInput.value = "";
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
            accountId.value = cells[0].textContent.trim();
            accountNameInput.value = cells[1].textContent.trim();
            accountPasswordInput.value = cells[2].textContent.trim();
            phoneInput.value = cells[3].textContent.trim();
            
            roleInput.value = cells[4].textContent.trim();
            console.log(roleInput.value);
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
        if (str_contains($message, "Ошибка")) {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        } else {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        }
    }
?>
</html> 