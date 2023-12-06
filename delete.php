<?php
    require "connect.php";
    //lấy id cần xóa
    $id=(int)$_GET['id'];
    //câu lệnh SQl xóa bản ghi hiện có tại cột có biến là id đã lấy ở trên
    $sql="DELETE FROM `products` WHERE `product_id`=($id)";
    $connect->exec($sql);
    header('Location:list.php');
?>
