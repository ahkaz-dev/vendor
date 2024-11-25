<?php
$user = "rootVendor";
$password = "bz8VHldnUp/_oAZK";
$dbname = "vendordb";
$conn = mysqli_connect("localhost", $user, $password, $dbname);

// Запрос на удаление повторяющихся строк в таблице
// Служит костылем для уже введеной формы и обновленной страницы
$sql = "
DELETE c1 FROM useraccount c1
JOIN useraccount c2 
ON c1.Login = c2.Login AND c1.Password = c2.Password
WHERE c1.UserId > c2.UserId;
";
if (mysqli_query($conn, $sql)) {
    echo "<script>console.log('Дубликаты удалены');". "</script>";

} else {
    echo "<script>console.log(". mysqli_error($conn) . ");". "</script>";
}