<!DOCTYPE html>
<html>
<head>
	<title>One column layout</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<table width="100%" border="1" cellpadding="4">
		<tr height="100px">
			<td>
				<?php echo $this->getChild("header")->toHtml(); ?>
			</td>
		</tr>
		<tr>
			<td><?php $message = new \Block\Core\Message(); 
				echo $message->toHtml();
			 ?></td>
		</tr>
		<tr height="400px">
			<td>
				<?php foreach ($this->getChild('content')->children as $child) : ?>
					<?php echo $child->toHtml();?>
				<?php endforeach; ?>
				<!-- <?php //echo $this->getChild("content")->toHtml(); ?> -->
			</td>
		</tr>
		<tr height="100px">
			<td>
				<?php echo $this->getChild("footer")->toHtml(); ?>
			</td>
		</tr>
	</table>
</body>
