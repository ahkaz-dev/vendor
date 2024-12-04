<?php 
session_start();

if (isset($_SESSION["admin-status"])) {
    unset($_SESSION["admin-status"]);
    header("Location: http://localhost/vendor_rabota");  
}