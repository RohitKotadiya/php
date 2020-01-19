<?php

	if(true){
		echo "great!, Its True<br>";
	}
	if(true):
		echo "its True<br>";
	else:
		echo "its false";
	endif;

	


	if(true){
		$greeting = "Hello";
	}
	echo $greeting."<br>";

	if(false){
		$greet ="Good Morning";
	}
	echo $greet."<br>";			//not defined bcaz condition false

	


	$charA = 'A';
	$charB = 'B';

	if($charA > $charB):
		echo "A is greater then B<br>";
	else:
		echo "B is greater then A<br>";
	endif;


	
	if(true > false){
		echo "true is greter then false<br>";
	}



	$price = 50;
	if($price > 100){
		echo "Price greter then 100 <br>";
	}
	else if($price > 50 && $price <= 100){
		echo "Price is betwwen 50 and 100<br>";
	}
	else{
		echo "price is 0";
	}




	
?>

<?php if(true): ?>
	<input type="text" value="Rohit">
<?php else: ?>
	<input type="text" value="Bye">
<?php endif ?> 

