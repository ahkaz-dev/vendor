<?php
session_start();
require_once '../config/db.php';  // Подключаем файл с подключением к базе данных
// Сообщение для отображения пользователю
$message = '';

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $phonenubmer = trim($_POST['phonenubmer']);
    try {
        // Сохраняем данные в базе
        $stmt = $pdo->prepare("INSERT INTO useraccount (Login, Password, PhoneNumber, StatusRole) VALUES (:login, :password, :number,'Пользователь')");
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':number', $phonenubmer, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $message = "Вы были зарегистрированы!";
        } else {
            $message = "Не удалось зарегистрироваться";
        }
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
} else if (isset($_GET['checkLogin'])) {
    $login = trim($_GET['inputlogin']);
    $password = trim($_GET['inputpassword']);
    try {
        // Пытаемся найти данные в базе
        $stmt = $pdo->prepare("SELECT * FROM useraccount WHERE Login=:login AND Password=:password");
        $stmt->execute(['login' => $login, 'password' => $password]);
        $user = $stmt->fetch();

        if (!empty($user)) {
            $_SESSION["admin-status"] = $user["StatusRole"]; 
            $_SESSION["admin-id"] = $user["UserId"]; 

            echo '<script type="text/javascript">';
            echo 'window.location.href = "http://localhost/vendor_rabota/admin/index.php";';
            echo '</script>';
        } else {
            $message = "Не удалось найти пользователя";
        }
    } catch (PDOException $e) {
        $message = "Ошибка: " . $e->getMessage();
    }
}
require_once '../config/dublicateQuery.php';  // Подключаем файл с запросом на дубликаты

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../static/style/login.css">
</head>
<body>
<?php 
    if ($message) {
        if (str_contains($message, "Вы")) {
            echo "<p><strong class='notification_yes'>$message</strong></p>";
        } else if (str_contains($message, "Не")) {
            echo "<p><strong class='notification_no'>$message</strong></p>";
        }
    }
?>  
<div class="login-page">
  <div class="form">
    <form class="register-form" method="POST">
        <h2>*Регистрация</h2>
        <label for="login">Введите логин</label><br>
        <input type="text" name="login" id="" required pattern="^[a-zA-Z][a-zA-Z _\-]{9,19}$" placeholder="Мой логин" maxlength="20"/>
        <span class="form-span-info">Используйте английские буквы, пробел,<br> _ или - <u>Размер логина от 10 до 20 символов</u></span><br><br>     

        <label for="password">Введите пароль</label><br>
        <label style="display:flex;">
        <input type="password" placeholder="Пароль" name="password" required pattern="^[a-zA-Z0-9!_\-\)\(]{8,16}$"  maxlength="16"/>
        <span onclick="let a=this.parentElement.children[0];(a.type==='password')?a.setAttribute('type','text'):a.setAttribute('type','password')" style='cursor:help;align-content: center;'>👁</span>
        </label>
         <span class="form-span-info">Используйте английские буквы,<br> цифры или знаки !_-)( <u>От 8 до 16 символов</u></span><br><br>     
    
        <label for="phonenubmer">Введите номер телефона</label><br>
        <input type="text" placeholder="Номер телефона" name="phonenubmer" required pattern="^\d{11}$" maxlength="11"/>
        <span class="form-span-info">Пример ввода номера телефона: 79182332322, 89189991313</span><br><br>       

    <button>Создать аккаунт</button>
    <p class="message">У вас уже есть аккаунт? <a href="#">Войдите</a></p>
    </form>
    <form class="login-form" method="GET">
        <h2>*Вход в аккаунт</h2>

        <input type="text" placeholder="Логин" required name="inputlogin" /><br><br>
        <label style="display:flex;">
            <input type="password" placeholder="Пароль" name="inputpassword" required/>
            <span onclick="let b=this.parentElement.children[0];(b.type==='password')?b.setAttribute('type','text'):b.setAttribute('type','password')" style='cursor:help;align-content: center;'>👁</span>
        </label><br>
        <button name="checkLogin">Войти</button>
        <p class="message">У вас еще нет аккаута? <a href="#">Зарегистрируйтесь</a></p>
    </form>
    <br><br><br>
    <div class="back-out">
    <input type="submit" value="ВЕРНУТЬСЯ" class='cancel' onclick="window.location='http://localhost/vendor_rabota/'"/>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>
</body>
</html>