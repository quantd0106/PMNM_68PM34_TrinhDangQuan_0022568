<?php
require_once '../app/core/App.php';
    class middleware {
        function checklogin() {
            $publicPages = [
                '/QLSINHVIEN/public/home/login',
                '/QLSINHVIEN/public/auth/login'
            ];
            if(!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)) {
                header('Location: /QLSINHVIEN/public/home/login');
                exit();
            }
        }
    }
?>