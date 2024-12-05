<?php 
session_start();
require_once('/xampp/htdocs/VENDOR_RABOTA/config/db.php');

try {
    // Пытаемся найти данные в базе
    $stmt = $pdo->prepare("SELECT * FROM AllPhoneWare ORDER BY PhoneId DESC LIMIT 4;");
    $stmt->execute();
} catch (PDOException $e) {
    $message = "Ошибка: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>
    <link rel="stylesheet" href="static/style/main.css">
</head>
<div>
    <!-- up button -->
    <a id="upbutton"></a>
    <header>
        <a href="#about-us">О нас</a>
        <a href="#anch-slider">Наши товары</a>
        <a href="#">Контакты</a>
        <a href="#">Помощь</a>
    </header>
    <main>
        <div class="md1"> <!-- main div 1 -->
            <h1 class="md1-mtext" draggable="false">VENDOR</h1> <!-- main div 1 - main text -->
            <div class="image-wrapper">
                <img src="static/img/png/main_iphone.png" alt="Phone" draggable="false">
            </div>
            <div class="call-to-action">
                    <a href="./forms/phonereg.php">Сделать звонок →</a>
            </div>
        </div>
        <div class="description">
            Мы верим что наша продукция становится частью большого прогресса для людей, которые ценят качество и инновации.
        </div>
        <div class="md1-links">
            <ul class="animated-links">
                <li><a href="#">Популярность</a></li>
                <li><a href="#">Востребованность</a></li>
                <li><a href="#">Уникальность</a></li>
                <li><a href="#">Незаменимость</a></li>
            </ul>
        </div>
    </main>
    <div class="md2">
        <div class="header-about-num">
            <div class="left" id="about-us">О НАС</div>
            <div class="line"></div>
            <div class="right">V<br>E<br>N<br>D<br>O<br>R</div>
        </div>
        <div class="md-content">
            <div class="content-image">
                <img src="./static/img/png/stevee_jobs.png" alt="" srcset="">
            </div>
            <div class="content-text">
                <p class="content-text-main">
                    Наша миссия — объединить наследие технологических гигантов и
                    <br>создать для вас опыт, достойный XXI века.
                    <br>Стив Джобс когда-то сказал: 
                </p>
                <p class="content-text-citata">
                    «Инновации отличают лидера от последователя»
                </p>     
                <p class="content-text-endtext">
                    Мы следуем этому принципу, предлагая только самые современные и стильные смартфоны.
                </p>
                <div class="slide-idea">
                    <div class="call-to-action-reverse">
                        <a href="admin/login.php">Попасть к нам →</a>
                    </div>   
                </div> 
                <div class="photo-name">
                    <p>Стив Джобс</p>
                    <span>CEO of Apple Inc</span>
                </div>                          
            </div>
        </div>
    </div>    
<div class="main-block">
    <!-- Полоска с названием -->
    <div class="header-block">
        <div class="liner"></div>
        <h1  id="anch-slider">ТОВАРЫ</h1>
    </div>

    <div class="text-block" style="border: 3px dashed rgba(184, 184, 184, 0.31); padding: 15px 15px 45px 2%; margin-left: 50px;">
        <span class="slider-label" style="text-align: left; font-size:large;">
            Какова наша Цель?
        </span>
        <p class="description-s" style="text-align: center;">Наша миссия — объединить наследие технологических гигантов и создать для вас опыт, достойный XXI века.<br>
        Обращайтесь за товарами к нам
        </p>
        <br>
        <div class="call-to-action-reverse">
            <a href="./forms/phonereg.php">Сделать звонок →</a>
        </div>
    </div>

    <div class="text-block-label" style="margin:2% 0px 0px 0px;display: flex;justify-content: center;">
        <h3 class="slider-label" style="color:#d1bb7e">
            Онлайн товары на складе
        </h3>
    </div>

    <div class="infinite-slider-container">
    <button class="slider-btn left-btn">‹</button>
        <div class="infinite-slider">
            <?php 
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) { ?>
                <div class="slide">
                    <h3><?= htmlspecialchars($row->PhoneMark) ?>  <?= htmlspecialchars($row->PhoneModel) ?></h3>
                    <p>Топовый смартфон c потрясающим дизайном.</p>
                    <span>Цена: <?= htmlspecialchars($row->PhonePrice) ?>$</span>
                </div>        
            <?php }
            ?>
        </div>
    <button class="slider-btn right-btn">›</button>
    </div>



    <div class="back-img-slider"></div>
    <div class="text-block-label" style="margin:2% 0px 0px 0px;display: flex;justify-content: center;">
        <p class="slider-label">
            Почему именно наши товары?
        </p>
    </div>
    <div class="content-block">
        <div class="item">
            <svg width="50" height="50">       
                <image xlink:href="https://www.svgrepo.com/show/164168/king.svg" width="50" height="50"/>    
            </svg>
            <h3>Популярность</h3>
            <p>Наши смартфоны пользуются огромной популярностью среди пользователей благодаря своим передовым технологиям и стильному дизайну.</p>
        </div>
        <div class="item">
            <svg width="50" height="50">       
                <image xlink:href="https://www.svgrepo.com/show/150950/heart.svg" width="50" height="50"/>    
            </svg>
            <h3>Востребованность</h3>
            <p>Мы предлагаем только те модели, которые наиболее востребованы на рынке, обеспечивая вам лучший выбор.</p>
        </div>
        <div class="item">
            <svg width="50" height="50">       
                <image xlink:href="https://www.svgrepo.com/show/2458/medal.svg" width="50" height="50"/>    
            </svg>
            <h3>Уникальность</h3>
            <p>Каждый смартфон в нашем магазине уникален и предлагает уникальные функции, которые вы не найдете нигде больше.</p>
        </div>
        <div class="item">
            <svg width="50" height="50">       
                <image xlink:href="https://www.svgrepo.com/show/101580/podium.svg" width="50" height="50"/>    
            </svg>
            <h3>Незаменимость</h3>
            <p>Наши смартфоны станут незаменимыми помощниками в вашей повседневной жизни, обеспечивая высокую производительность и надежность.</p>
        </div>
    </div>  
    <div class="text-block" style="display: flex; flex-direction: column; max-width: none; padding-left: none; align-items: center;">
        <span class="slider-label" style="text-align: center; font-size:large;">
            Нашли свой идеальный телефон?
        </span>
        <p class="description-s" style="text-align: center;">
        <u>Нажмите кнопку</u> ниже и <u>оставьте нам свой номер телефона</u>.<br>Это поможет нам связаться с вами, предложить лучшие условия покупки и ответить на все ваши вопросы. <br>
        <br>Мы ценим ваше время и стремимся сделать ваш опыт покупки максимально приятным и комфортным.
        </p>
        <br>
        <div class="call-to-action-reverse" style="margin-bottom:45px;" >
            <a href="./forms/phonereg.php" style="font-size: 16px;">Оставить номер →</a>
        </div>
    </div>     
</div>
<div class="footer">
  <div class="footer-container">
    <div class="footer-links">
      <a href="#about-us">О нас</a>
      <a href="#anch-slider">Наши товары</a>
      <a href="#contacts">Контакты</a>
      <a href="#help">Помощь</a>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 Vendor. Все права защищены.</p>
    </div>
  </div>
</div>

    <script type="text/javascript" src="static/js/slider_main.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="static/js/up_button.js" ></script>
</body>
</html>
