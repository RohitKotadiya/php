<?php $method = $this->getMethod(); ?>
<?php $statusOptions = $this->getStatusOptions(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Method</title>
</head>
<body>
	<form action="<?php echo $this->getUrl("save", null, ['id' => $method->id]); ?>" method="POST">
		<table border="1" width="100%" cellpadding="4">
			<tbody>
				<tr>
					<td>Name</td>
					<td><input type="text" name="method[name]" value="<?php echo $method->name ?>"></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td><input type="text" name="method[amount]" value="<?php echo $method->amount ?>"></td>
				</tr>
				<tr>
					<td>Status</td>
					<td><select name="method[status]">
							<?php foreach ($statusOptions as $status => $label) : ?>
								<?php $selected = ($status == $method->status) ? "selected" : "" ?>
								<option value="<?php echo $status ?>" <?php echo $selected; ?>><?php echo $label; ?></option>	
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="SAVE"></td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>