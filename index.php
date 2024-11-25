<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>
    <link rel="stylesheet" href="static/style/main.css">
</head>
<body>
    <!-- up button -->
    <a id="upbutton"></a>
    <header>
        <a href="#about-us">О нас</a>
        <a href="#">Наши товары</a>
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
                        <a>Попасть к нам →</a>
                    </div>   
                </div> 
                <div class="photo-name">
                    <p>Стив Джобс</p>
                    <span>CEO of Apple Inc</span>
                </div>                          
            </div>
        </div>
    </div>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="static/js/up_button.js" ></script>
</body>
</html>
