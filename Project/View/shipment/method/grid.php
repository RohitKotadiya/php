<?php $methods = $this->getMethods(); ?>
<?php $statusOptions = $this->getStatusOptions(); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="<?php echo $this->getUrl("add"); ?>">ADD METHOD</a>
	<br><br>
	<form action="<?php echo $this->getUrl("delete") ?>" method="POST">
		<table border="1" width="100%" cellpadding="4">
			<thead>
				<tr>
					<th></th>
					<th>Id</th>
					<th>name</th>
					<th>Status</th>
					<th>Amount</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php if($methods == null) : ?>
					<tr>
						<td colspan="6">No methods found.</td>
					</tr>
				<?php else : ?>
					<?php foreach ($methods as $method) : ?>
						<tr>
							<td><input type="checkbox" name="methodId[]" value="<?php echo $method->id ?>"></td>
							<td><?php echo $method->id; ?></td>	
							<td><?php echo $method->name; ?></td>	
							<td><?php echo $statusOptions[$method->status]; ?></td>	
							<td><?php echo $method->amount; ?></td>	
							<td><a href="<?php echo $this->getUrl("edit", null, ['id' => $method->id]); ?>">EDIT</a></td>	
							<td><a href="<?php echo $this->getUrl("delete", null, ['id' => $method->id]); ?>">DELETE</a></td>	
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<br>
		<input type="submit" name="submit" value="DELETE SELECTED">
	</form>
</body>
</html>