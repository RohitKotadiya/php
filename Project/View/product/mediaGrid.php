<?php $productImages = $this->getProductMedia(); ?>
<?php $product = $this->getProduct();?>
<!DOCTYPE html>
<html>
<head>
	<title>Media</title>
</head>
<body>
	<form action="<?php echo $this->getUrl("saveImage", "product_media" , ['id' => $product->id]); ?>" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td><input type="file" name="image"></td>
			<tr>
			<tr>
				<td><input type="submit" name="ADD IMAGE" value="ADD IMAGE"></td>
			<tr>
		</table>

	</form>
	<br><br>
	<form method="POST" action="<?php echo $this->getUrl("updateMedia","product_media" , ['id' => $product->id]); ?>">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Image</th>
					<th>Base</th>
					<th>Thumbnail</th>
					<th>Small</th>
					<th>Exclude </th>
					<th>Action</th>
				</tr>
			</thead>
			<?php if(!$productImages) : ?>
				<tr>
					<td colspan="6">No Images Found.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($productImages as $key => $value): ?>
					<tr>
						<td><img src="<?php echo "media\catalog\product\\$value->image"; ?>" alt="" height="150px" width="150px"></td>
						<?php $selected = ($value->image == $product->baseImage)? "checked" : "" ?>
						<td><input type="radio" name="product[baseImage]" value="<?php echo $value->image ?>" <?php echo $selected; ?> ></td>
						<?php $selected = ($value->image == $product->thumbnail)? "checked" : "" ?>
						<td><input type="radio" name="product[thumbnail]" value="<?php echo $value->image ?>" <?php echo $selected; ?>></td>
						<?php $selected = ($value->image == $product->smallImage)? "checked" : "" ?>
						<td><input type="radio" name="product[smallImage]" value="<?php echo $value->image ?>" <?php echo $selected; ?>></td>
						<?php $checked = ($value->excludedImage == 1) ? "checked" : "" ?>
						<td><input type="checkBox" name="excludeImage[]" value="<?php echo $value->id ?>" <?php echo $checked; ?>></td>
						<td><a href="<?php echo $this->getUrl("deleteMedia", null , ['imageId' => $value->id, 'productId' => $product->id]); ?>">DELETE</a>
					</tr>	
				<?php endforeach; ?>
			<?php endif; ?>
		</table>
		<br><br>
		<input type="submit" name="update" value="UPDATE">
	</form>
</body>
</html>