<?php 
session_start();
require_once('/xampp/htdocs/VENDOR_RABOTA/config/db.php');
$message = '';

if (isset($_SESSION["admin-status"])) { 
    if ($_SESSION["admin-status"] == "Модератор") { 
    try {
        // Пытаемся найти данные в базе
        $stmt = $pdo->prepare("SELECT * FROM customer ORDER BY CustomerId ASC");
        $stmt->execute();

    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Звонки</title>
    <link rel="stylesheet" href="/vendor_rabota/static/style/login.css">
    <link rel="stylesheet" href="/vendor_rabota/static/style/view/usercalls.css">
</head>
<body style="background-color:white;">
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
                <th>Идентификатор номера</th>
                <th>Имя заказчика</th>
                <th>Номер телефона заказчика</th>
                <th>Действия</th>
            </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row->CustomerId) . '</td>';
            echo '<td>' . htmlspecialchars($row->Name) . '</td>';
            echo '<td>' . htmlspecialchars($row->PhoneNumber) . '</td>';
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
</body>
</html> 
<?php
    } else { ?>
        <p>У вас нет доступа к этой странице</p>
<?php } } ?>