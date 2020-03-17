<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
	<style type="text/css">
		.success {
			color: green;
		}
		.warning {
			color : grey;
		}
		.failure {
			color: red;
		}
		.notice {
			color: grey;
		}
	</style>
</head>
<body>			

	<?php $message = $this->getMessage(); ?>

	<?php if($message) : ?>
		<?php foreach ($message as $key => $value) : ?>
			<?php if($value) : ?>
				<div class="<?php echo $key ?>"><?php  echo $value; ?></div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</body>
</html>