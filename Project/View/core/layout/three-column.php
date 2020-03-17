<!DOCTYPE html>
<html>
<head>
	<title>Thrre column layout</title>
</head>
<body>
	<table width="100%" border="1" cellpadding="4">
		<tr height="100px" >
			<td colspan="3">Header</td>
		</tr>
		<tr height="400px">
			<td width="50px">left</td>
			<td><?php foreach ($this->getChild('content')->children as $child) : ?>
					<?php echo $child->toHtml();?>
				<?php endforeach; ?>	
			</td>
			<td width="50px">right</td>
		</tr>
		<tr height="100px" >
			<td colspan="3">Footer</td>
		</tr>
	</table>
</body>
