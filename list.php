<?php
    require "connect.php";
    //lấy dữ liệu từ bảng products
    $sql="SELECT * FROM `products`";
    $data=$connect->query($sql);
    $list_pro=$data->fetchAll();
    $list_cat=$data->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            margin: 0 auto;
        }
        table{}
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách sản phẩm</h1>
        <button class="btn btn-success">
            <a href="addproduct.php" class="upload text-decoration-none text-dark">Thêm sản phẩm</a>
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Total</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //câu lệnh lặp để lấy tất cả giá trị có trong bảng products
                foreach ($list_pro as $pro) {
                    ?>
            <tr>
                <!-- lấy giá trị trong bảng products hiển thị ra màn hình -->
                <td><?php echo $pro['product_id']?></td>
                <td><img src="./path/<?= $pro['image'] ?>" alt="" style="width: 70px;height: 50px; object-fit: cover"></td>
                <td><?php echo $pro['total']?></td>
                <td><?php echo $pro['description']?></td>
                <td><?php echo $pro['category_id']?></td>
                <td>
                    <button class="btn btn-danger">
                        <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?php echo $pro['product_id']?>" class="text-decoration-none text-dark">Xóa</a>
                    </button>
                    <button class="btn btn-primary">
                        <a href="update.php?id=<?php echo $pro['product_id']?>" class="text-decoration-none text-white">Sửa</a>
                    </button>
                </td>
            </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>