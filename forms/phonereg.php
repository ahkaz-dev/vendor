<?php

$user = "rootVendor";
$password = "bz8VHldnUp/_oAZK";
$dbname = "vendordb";
$conn = mysqli_connect("localhost", $user, $password, $dbname);
date_default_timezone_set('Europe/Moscow');


session_start();

// Генерация случайной строки для CAPTCHA
function generateCaptchaText($length = 5) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captchaText = '';
    for ($i = 0; $i < $length; $i++) {
        $captchaText .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captchaText;
}

// Переменная для сообщения о результате
$message = '';

// Если форма была отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные формы
    $phoneNumber = $_POST['phonenubmer'];
    $username = $_POST['username'];
    $agree = isset($_POST['agree']) ? $_POST['agree'] : false;
    $userInput = $_POST['captcha_input']; // Получаем введённый пользователем текст

    // Проверка CAPTCHA
    if ($userInput === $_SESSION['captcha_text']) {
        $message = "Капча пройдена успешно!";
    } else {
        $message = "<span style='color: #e74646;font-weight: 500;'>Неверный текст капчи</span>. Попробуйте снова.";
        $_SESSION['captcha_text'] = generateCaptchaText();
    }

    if ($message === "Капча пройдена успешно!" && $phoneNumber && $username && $agree) {
        $add = "INSERT INTO `customer` (`Name`, `PhoneNumber`) VALUES ('$username', '$phoneNumber')";
        $addCustomer = mysqli_query( $conn, $add);
        $_SESSION["phonePage"] = 1;

        $message = "Форма отправлена успешно!";
    }
} else {
    // Генерация CAPTCHA текста и сохранение в сессии, если форма ещё не отправлялась
    $_SESSION['captcha_text'] = generateCaptchaText();
}


require_once '../config/dublicateQuery.php';  // Подключаем файл с запросом на дубликаты


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сделать звонок</title>
    <link rel="stylesheet" href="../static/style/forms.css">
</head>
<body>
    <div class="side-slide"></div>
    <div class="header-about-num">
        <div class="left">ЗВОНОК</div>
        <div class="line"></div>
        <div class="right">V<br>E<br>N<br>D<br>O<br>R</div>
    </div>
    <div class="form-num">
    <!-- Ваша форма с добавленной CAPTCHA -->
    <form class="num-label" method="POST">
        <label for="phonenubmer" align='left'>Введите номер телефона</label><br>
        <input type="text" name="phonenubmer" id="" required pattern="^\d{11}$" placeholder="Мой номер" maxlength="11"><br>
        <span style="font-size: 15px; color: #8b8b8b;">Пример ввода номера телефона: 79182332322, 89189991313</span>        
        <br><br>

        <label for="username">Введите ваше имя</label><br>
        <input type="text" name="username" id="" required pattern="^[а-яА-ЯёЁ]{1,20}$" placeholder="Моё имя" maxlength="20"><br>
        <span style="font-size: 15px; color: #8b8b8b;">Используйте только кирилицу для записи имени</span>        
        <br><br>

        <div class="terms-container">
            <input type="checkbox" id="agree" name="agree" required>
            <label for="agree" class="agree">
                Я даю согласие на обработку моих персональных данных и подтверждаю, что ознакомлен с 
                <a href="https://w.wiki/C85f" target="_blank">условиями использования</a>.
            </label>
        </div>
        <br>

        <!-- CAPTCHA -->
        <label for="captcha_input">Капча:</label>
            <span class="captcha-block"><?php echo $_SESSION['captcha_text']; ?></span><br> <!-- Отображаем CAPTCHA текст -->
        <input type="text" id="captcha_input" name="captcha_input" required placeholder="Введите капчу" maxlength="5"><br>
            <!-- Если был результат проверки CAPTCHA, выводим сообщение -->
        <?php if ($message) : ?>
            <p><?php echo $message; ?></p><br>
        <?php endif; ?>
        <!-- Кнопки -->
        <input type="submit" value="Отмена" class='cancel' onclick="window.location='http://localhost/vendor_rabota/'">
        <input type="submit" value="Отправить" class="submit" name="phoneGo">   
    </form>
    </div>
    <br>        
    </div>
</body>
</html>