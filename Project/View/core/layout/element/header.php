 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


 </head>
 <body>
 	<nav class="navbar navbar-expand-lg navbar-light bg-light">
 		<div class="collapse navbar-collapse">
 			<a class="navbar-brand" href="#">Project</a>

	 		<ul class="navbar-nav mr-auto" >
			 	<li class="nav-item"><a class="nav-link" href="<?php echo $this->getUrl("showProduct","Products"); ?>">Manage Prodcuts</a>
			 	<li class="nav-item"><a class="nav-link" href="<?php echo $this->getUrl("showCategory","Categories"); ?>">Manage Categories</a>
			 	<li class="nav-item"><a class="nav-link" href="<?php echo $this->getUrl("showCustomer","Customers"); ?>">Manage Customers</a>
			 	<li class="nav-item"><a class="nav-link" href="<?php echo $this->getUrl("show","Payment_Methods"); ?>">Manage Payment Methods</a>
			 	<li class="nav-item"><a class="nav-link" href="<?php echo $this->getUrl("grid","Shipment_Methods"); ?>">Manage Shipment Methods</a>
	 		</ul>
	 	</div>
 	</nav>
 </body>
 </html>