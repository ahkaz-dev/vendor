<?php 
session_start();
require_once '../config/db.php';  // Подключаем файл с подключением к базе данных
// Сообщение для отображения пользователю
$message = '';

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $name = trim($_POST['name']); 
    $tel = trim($_POST['tel']);
    $message = trim($_POST['message']);
    try {
        // Сохраняем данные в базе
        $stmt = $pdo->prepare("INSERT INTO UserMessage (ByWho, Phone, MessageText) VALUES (:ByWho, :Phone, :MessageText)");
        $stmt->bindParam(':ByWho', $name, PDO::PARAM_STR);
        $stmt->bindParam(':Phone', $tel, PDO::PARAM_STR);
        $stmt->bindParam(':MessageText', $message, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $message = "Сообщение отправлено!";
        } else {
            $message = "Ошибка отправки";
        }
    } catch (PDOException $e) {
        $message = "Ошибка сообщения";
    }
}

require_once '../config/dublicateQuery.php';  // Подключаем файл с запросом на дубликаты
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link rel="stylesheet" href="../static/style/login.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .contact-info {
            margin: 20px 0;
            line-height: 1.8;
        }

        .contact-info a {
            color: #F3C623;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .feedback-form {
            margin: 30px 30px;
        }

        .feedback-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .feedback-form input,
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .feedback-form button {
            background-color: #F3C623;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .feedback-form button:hover {
            opacity: 0.7;
        }

        .map {
            margin-top: 30px;
            text-align: center;
        }

        .map iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php 
    if ($message) {
        if (str_contains($message, "Ошибка")) {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        } else {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        }
    }
?>     
    <div class="container">
        <a href="../index.php">Главная</a>
        <h1>Контакты</h1>
        <div class="contact-info">
            <p>Напишите на email: <a href="mailto:vendor@gmail.com">vendor@gmail.com</a></p>
            <p>Или позвоните по телефону: <a href="tel:+11234567890">+1 (123) 456-7890</a></p>
            <p>Если у вас остались вопросы, то напишите нам. Мы с удовольствием ответим вам в ближайшее время!</p>
        </div>

        <div class="feedback-form">
            <h2>Оставьте нам сообщение</h2>
            <form action="" method="POST">
                <label for="name">Ваше имя:</label>
                <input type="text" id="name" name="name" required maxlength="20" placeholder="Имя">

                <label for="email">Ваш номер телефона:</label>
                <input type="text" id="tel" name="tel" pattern="^\d{11}$" maxlength="11" required  placeholder="89189991313">

                <label for="message">Ваше сообщение:</label>
                <textarea id="message" name="message" rows="5" required maxlength="550" placeholder="Мой отзыв"></textarea>

                <button type="submit">Отправить</button>
            </form>
        </div>

        <div class="map">
            <h2>Наш офис</h2>
            <iframe 
                src="https://yandex.ru/map-widget/v1/-/CHEAZSkD"
                allowfullscreen="" 
                loading="lazy"></iframe>
        </div>
    </div>
</body>

</html>
