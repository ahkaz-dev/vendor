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

$sqlPhone = "
DELETE c1 FROM AllPhoneWare c1
JOIN AllPhoneWare c2 
ON c1.PhoneMark = c2.PhoneMark AND c1.PhoneMark = c2.PhoneMark AND c1.PhoneModel = c2.PhoneModel AND c1.CountInStorage = c2.CountInStorage AND c1.PhonePrice = c2.PhonePrice
WHERE c1.PhoneId > c2.PhoneId;";
if (mysqli_query($conn, $sqlUserAccount) AND mysqli_query($conn, $sqlCustomer) AND mysqli_query($conn, $sqlPhone)) {
    echo "<script>console.log('Дубликаты удалены');". "</script>";

} else {
    echo "<script>console.log(". mysqli_error($conn) . ");". "</script>";
}