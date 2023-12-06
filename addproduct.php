<?php
	//kết nối với file connect
	require "connect.php";

	// truy vấn cơ sở dữ liệu lấy dữ liệu từ bảng categories
	$sql="SELECT * FROM `categories`";
	$data=$connect->query($sql);
	$list_cate=$data->fetchAll();

	//lệnh php thực thi khi click vào button
	if(isset($_POST['btn_insert'])){
		//gán trường trong SQl vào biến
		$describle=$_POST['description'];
		$total=$_POST['total'];
		$category=$_POST['category'];

		//kiểm tra giá trị là số dương
		if ($total > 0) {
			echo "Giá trị là số dương.";
		} else {
			echo "Giá trị không phải là số dương.";
		}
		
		//đẩy file ảnh lên data
		$targetFile = './path/' . time() . $_FILES['image']['full_path'];
		$path = time() . $_FILES['image']['full_path'];
		move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
		
		// câu lệnh để chèn giá trị trực tiếp vào biến
		$sql="INSERT INTO `products` (`image`,`total`,`description`,`category_id`) 
				VALUES ('{$path}','{$total}','{$describle}','{$category}')";
		$connect->exec($sql);
		//trở về trang danh sách sau khi thực hiện xong câu lệnh php
		header('Location:list.php');
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="container">
	<h1>Thêm sản phẩm</h1>
			<div id="addproduct" class="addproduct border border-dark rounded my-3 p-2">
				<form action="" class="form" method="POST" enctype="multipart/form-data"> 
                    <div class="form-group ">
						<label for="image">Image</label>
						<input type="file" name="image" id="image" />
					</div>
                    <div class="form-group ">
						<label for="total">Total</label>
						<input type="number" name="total" id="total" min="0"/>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" name="description" id="description" />
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select name="category" class="form-select" id="category">
							<option value="">--Chọn--</option>
							<?php
								//thực hiện vòng lặp để lấy tên danh mục trong bảng categories
							 	foreach($list_cate as $cate){
							?>	
								<!-- hiển thị các giá trị có trong -->
								<option value="<?php echo $cate['category_id']?>"><?php echo $cate['category_name']?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-footer">
						<input class="btn btn-primary mt-2" type="submit" value="Thêm" name="btn_insert" />
						<a href="list.php">
						</a>
					</div>
				</form>
			</div>
		</div>
</body>
</html>