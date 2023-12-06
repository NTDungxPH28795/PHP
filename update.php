<?php
    require "connect.php";
    $id=(int)$_GET['id'];
    $sql="SELECT * FROM `products` WHERE `product_id`={$id}";
    $data=$connect->query($sql);
    $pro_update=$data->fetch();

    $sql="SELECT * FROM `categories`";
	$data=$connect->query($sql);
	$list_cate=$data->fetchAll();
	if(isset($_POST['btn_insert'])){
		$describle=$_POST['description'];
		$total=$_POST['total'];
		$category=$_POST['category'];

		if ($total > 0) {
			echo "Giá trị là số dương.";
		} else {
			echo "Giá trị không phải là số dương.";
		}
		
		$targetFile = './path/' . time() . $_FILES['image']['full_path'];
		$path = time() . $_FILES['image']['full_path'];
		move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

		// $file = $_FILES['image'];
		// $fileName = $file['name'];
		if($path === ""){
			$sql="UPDATE `products` SET `image`='{$path}',`total`='{$total}',`description`='{$describle}',`category_id`='{$category}' WHERE `product_id`='{$id}'";
		}else{
			$sql="UPDATE `products` SET `total`='{$total}',`description`='{$describle}',`category_id`='{$category}' WHERE `product_id`='{$id}'";
		}
		$connect->exec($sql);
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
	<h1>Cập nhật sản phẩm</h1>
			<div id="addproduct" class="addproduct border border-dark rounded my-3 p-2">
				<form action="" class="form " method="POST" enctype="multipart/form-data">
                    <div class="form-group">
						<label for="image">Image</label>
						<input type="file" name="image" id="image" value="<?php echo $pro_update['image']?>" />
					</div>
                    <div class="form-group">
						<label for="total">Total</label>
						<input type="number" min="0" name="total" id="total" value="<?php echo $pro_update['total']?>" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" name="description" id="description" value="<?php echo $pro_update['description']?>" />
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select name="category" class="form-select" id="category">
							<option value="">--Chọn--</option>
							<?php
							 	foreach($list_cate as $cate){
							?>
								<option value="<?php echo $cate['category_id']?>"<?php if($pro_update['category_id']==$cate['category_id']) echo "selected"?>><?php echo $cate['category_name']?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-footer">
						<input class="btn btn-primary mt-2" type="submit" value="Cập nhật" name="btn_insert" />
					</div>
				</form>
			</div>
		</div>
</body>
</html>