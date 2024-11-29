<?php 
session_start();

if (isset($_SESSION["admin-status"])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дашборд</title>
    <link rel="stylesheet" href="../static/style/view/dashboard.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="http://localhost/vendor_rabota/" class="header-link">Главная</a>
        <a href="#" class="header-link">Раздел</a>
        <a href="#" class="header-link">Помощь</a>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <a href="http://localhost/vendor_rabota/" class="breadcrumb-link">Главная</a>
        <span>•</span>
        <a href="#" class="breadcrumb-link">Дашборд</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="content-item">
            <h2 class="category-title">Название категории</h2>
            <div class="item-content">
                <div class="image-placeholder"></div>
                <div class="text-content">
                    <h3 class="item-title">Название?</h3>
                    <p class="item-description">Какой то текст который вписывается сюда как краткое описание раздела</p>
                    <a href="#" class="button">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="content-item">
            <h2 class="category-title">Звонки</h2>
            <div class="item-content">
                <div class="image-placeholder"></div>
                <div class="text-content">
                    <h3 class="item-title">Кто оставил номер?</h3>
                    <p class="item-description">
                        Раздел в котором хранятся данные пользователей, который в свою очередь оставили свои контакты для обратной связи
                    </p>
                    <a href="http://localhost/vendor_rabota/admin/view/usercalls.php" class="button">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="content-item">
            <h2 class="category-title">Название категории</h2>
            <div class="item-content">
                <div class="image-placeholder"></div>
                <div class="text-content">
                    <h3 class="item-title">Название?</h3>
                    <p class="item-description">Какой то текст который вписывается сюда как краткое описание раздела</p>
                    <a href="#" class="button">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="content-item">
            <h2 class="category-title">Название категории</h2>
            <div class="item-content">
                <div class="image-placeholder"></div>
                <div class="text-content">
                    <h3 class="item-title">Название?</h3>
                    <p class="item-description">Какой то текст который вписывается сюда как краткое описание раздела</p>
                    <a href="#" class="button">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
} else { ?>
<p>У вас нет доступа к этой странице</p>
<?php
}  
?>