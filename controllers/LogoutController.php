<?php 
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['acesso']);
    unset($_SESSION['user']);
    unset($_SESSION['senha']);
    header('location: ../pages/TelaLogin.php');



?>