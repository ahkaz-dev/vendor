<?php
$user = "rootVendor";
$password = "bz8VHldnUp/_oAZK";
$dbname = "vendordb";
$conn = mysqli_connect("localhost", $user, $password, $dbname);

// Запрос на удаление повторяющихся строк в таблице
// Служит костылем для уже введеной формы и обновленной страницы
$sqlUserAccount = "
DELETE c1 FROM useraccount c1
JOIN useraccount c2 
ON c1.Login = c2.Login AND c1.Password = c2.Password
WHERE c1.UserId > c2.UserId;";

$sqlCustomer = "
DELETE c1 FROM customer c1
JOIN customer c2 
ON c1.Name = c2.Name AND c1.PhoneNumber = c2.PhoneNumber
WHERE c1.CustomerId > c2.CustomerId;";
if (mysqli_query($conn, $sqlUserAccount) AND mysqli_query($conn, $sqlCustomer)) {
    echo "<script>console.log('Дубликаты удалены');". "</script>";

} else {
    echo "<script>console.log(". mysqli_error($conn) . ");". "</script>";
}