<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешно</title>
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
    <?php if (isset($_SESSION['phonePage'])) : ?>
        <label for="phonenubmer" align='left'>Мы сохранили ваш номер, ждите нашего звонка!</label><br>
    <?php endif; ?>
    <input type="submit" value="На главную" class='cancel' onclick="window.location='http://localhost/vendor_rabota/'">
    </form>
    </div>
    <br>        
    </div>
</body>
</html>