<?php
        $find = array(
            'rohit',
            ' ankit'
            );
		$replace = array(
            'r***t',
            "a***t"
            );

		if(isset($_POST['userInput']) && !empty($_POST['userInput']))
		{
			$user_input = $_POST['userInput'];
            echo $user_input . '<br>';

			$new_str = str_replace($find, $replace, $user_input);    // it will calculate 'Ankit' and 'ankit' as diff words
																     // so We have to user "strtolower()" 												
			echo "$new_str";
			$new_str2 = str_ireplace($find, $replace, $user_input); // it will calculate 'Ankit' and 'ankit' as same words
			echo "<br> With iReplace function : $new_str2 ";
        }
?>
<hr>
<form action='word_censoring_1.php' method='POST'>
	<textarea name="userInput",cols="50",rows="15"></textarea>
	<input type="submit" value="submit"> 
</form>