<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЧАВО - FAQ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .faq-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .faq-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }
        .faq-block {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .faq-header {
            padding: 15px;
            background: #5b574b;
            color: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }
        .faq-header:hover {
            background: #4a483d;
        }
        .faq-content {
            display: none;
            padding: 15px;
            font-size: 16px;
            background-color: #f9f9f9;
        }
        .faq-content ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        .faq-header .toggle-icon {
            font-size: 20px;
        }
        .faq-gif {
            width: 100%;
            max-width: 800px; /* Максимальная ширина гифки */
            margin-top: 20px; /* Отступ сверху */
            display: block;
            margin-left: auto;
            margin-right: auto; /* Центрирование */
        }

    </style>
</head>
<body>
    <div class="faq-container">
        <a href="../index.php">Главная</a>
        <div class="faq-title">Часто задаваемые вопросы (ЧАВО)</div>
        <p>
        Добро пожаловать на страницу оффлайн-поддержки!<br>
        Здесь вы сможете узнать как работать с нашим сайтом, для этого мы ответили на вопросы ниже.
        </p>
        
        <div class="faq-block">
            <div class="faq-header">
                <span>Как зарегистрироваться на сайте?</span>
                <span class="toggle-icon">+</span>
            </div>
            <div class="faq-content">
                <p>Чтобы зарегистрироваться, выполните следующие действия:</p>
                <ul>
                    <li>Перейдите на главную страницу.</li>
                    <li>Нажмите кнопку "Попасть к нам".</li>
                    <li>Заполните форму с вашими данными.</li>
                    <li>Вы вошли!</li>
                </ul>
                <img src="/vendor_rabota/static/img/gif/how-to-reg-log.gif" alt="Регистрация и вход" class="faq-gif">
            </div>
        </div>

        <div class="faq-block">
            <div class="faq-header">
                <span>Как работать с данными на сайте? <span style="opacity:0.8;">Версия: Пользователь</span></span>
                <span class="toggle-icon">+</span>
            </div>
            <div class="faq-content">
                <p>Для просмотра данных:</p>
                <ul>
                    <li>Откройте раздел "Дашборд" через меню на главной странице.</li>
                    <li>Выберите нужную категорию данных</li>
                    <li>Вам откроется страница со всеми данными в системе</li>
                    <li>Для навигации по дашборду используйте меню</li>
                </ul>
                <img src="/vendor_rabota/static/img/gif/user-data-work.gif" alt="Просмотр данных" class="faq-gif">
                <p>Вы хотите работать с данными напрямую? Читайте ниже</p>
            </div>
        </div>

        <div class="faq-block">
            <div class="faq-header">
                <span>Как работать с данными на сайте? <span style="opacity:0.8;">Версия: Модератор</span></span>
                <span class="toggle-icon">+</span>
            </div>
            <div class="faq-content">
                <p>Для работы с данными:</p>
                <ul>
                    <li>Получите доступ у администрации сайта, либо у других модераторов.</li>
                    <li>Откройте раздел "Дашборд" через меню на главной странице.</li>
                    <li>Выберите нужную категорию данных</li>
                </ul>

                <p>Добавление:</p>
                <ul>
                    <li>Нажмите на кнопку "Добавить"</li>
                    <li>Вам откроется форма добавления.</li>
                    <li>Заполните следуя примерам</li>
                    <li>Нажмите кнопку "Отправить"</li>
                </ul>
                <img src="/vendor_rabota/static/img/gif/admin-add.gif" alt="Добавление новых данных" class="faq-gif">

                <p>Редактирование:</p>
                <ul>
                    <li>Выберите нужную запись в таблице, нажмите ЛКМ</li>
                    <li>Вам откроется форма добавления с уже готовыми данными.</li>
                    <li>Измение данные следуя примерам</li>
                    <li>Нажмите кнопку "Обновить"</li>
                </ul>
                <img src="/vendor_rabota/static/img/gif/admin-update.gif" alt="Изменение данных" class="faq-gif">

                <p>Удаление:</p>
                <ul>
                    <li>Выберите нужную запись в таблице, нажмите кнопку "Удалить"</li>
                    <li>Нужная вам запись удалится из таблицы</li>
                </ul>
                <img src="/vendor_rabota/static/img/gif/admin-delete.gif" alt="Удаление данных" class="faq-gif">
            </div>
        </div>

        <div class="faq-block">
            <div class="faq-header">
                <span>Куда обратиться при возникновении проблем?</span>
                <span class="toggle-icon">+</span>
            </div>
            <div class="faq-content">
                <p>Если у вас возникли проблемы, обратитесь в службу поддержки:</p>
                <ul>
                    <li>Напишите на email: vendor@gmail.com</li>
                    <li>Или позвоните по телефону: +1 (123) 456-7890</li>
                    <li>Опишите вашу проблему и предоставьте максимум информации.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.faq-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const icon = header.querySelector('.toggle-icon');

                // Toggle the display state
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
                
                // Toggle the icon
                icon.textContent = icon.textContent === '+' ? '−' : '+';
            });
        });
    </script>
</body>
</html>
