<?php
    // Kết nối với database
    // Tham số
    $hostname='localhost';
    $db_name='db_shop';
    $username='root';
    $password="";
    // tạo PDO
    try{
        $connect=new PDO("mysql:host=$hostname;dbname=$db_name",$username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>