<?php
    require_once "postUserData.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>Registraion</title>
      <link rel="stylesheet" type="text/css" href="register.css">
        <style>
            span{
                color : red;
            }
        </style>
</head>
<body>
    <form method="POST" action ="register.php">
        <div id="register">
            <label>First Name</label>
            <select name="register[prefix]" >
                    <?php $prefixList = ['Mr', 'Miss' , 'Dr' , 'Mrs']; ?>                 
                    <?php foreach($prefixList as $value) :  ?>
                    <?php $selected = (getFieldValue('register','prefix') == $value ? "selected" : ""); ?>
                            
                    <option value="<?= $value ?>" <?= $selected ?> > <?= $value ?> </option>
                    <?php endforeach; ?>
            </select> 
            <input type="text" name="register[firstName]" value="<?= getFieldValue('register', 'firstName') ?>">
                <span> <?= validateField('register','firstName') ?> </span><br>
                <label>Last Name</label>
                <input type="text" name="register[lastName]"  value=<?= getFieldValue("register", "lastName") ?>>
                <span> <?= validateField('register','lastName') ?> </span><br>
                <label>Phone Number</label>
                <input type="number" name="register[phoneNumber]"  value=<?= getFieldValue('register', 'phoneNumber') ?>>
                <span> <?= validateField('register','phoneNumber') ?> </span><br>
                <label>Email Id</label>
                <input type="text" name="register[emailAddress]"  value=<?= getFieldValue('register', 'emailAddress') ?> >
                <span> <?= validateField('register','emailAddress') ?> </span><br>
                <label>Password</label>
                <input type="password" name="register[password]" value = <?= getFieldValue('register', 'password')?>>
                <span> <?= validateField('register','password') ?> </span><br>
                <label>Confirm Password</label>
                <input type="password" name="register[confirmPass]" value= <?= getFieldValue('register', 'confirmPass') ?> >
                <span> <?= validateField('register','confirmPass') ?> </span><br>
                <label id="specialLbl">Describe Your Self</label>
                <textarea cols="50" rows="8" name="register[selfInfo]" ><?= getFieldValue('register', 'selfInfo') ?></textarea>
                <span> <?= validateField('register','selfInfo') ?> </span><br><br>
            
                <input type="checkbox" name="register[chkCondition]" value="1">Hereby , I accept terms and conditions
                <span> <?= validateField('register','chkCondition') ?> </span><br><br>

            </div>
        
        <input type="submit" name="submit" value="REGISTER">
    </form>
</body>
</html>

<?php
    if(isset($_POST['submit'])) {
        if($flag == 1){
            echo "Ready to insert";   //write code to preprocess and then insert
            prepareUserData('insert');
        }else {
            echo "Error";
        }
    }
?>