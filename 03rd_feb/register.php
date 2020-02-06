<?php
    require_once "postUserData.php";
    require_once "updateRecord.php";
    $userData =[]; // store data of edit User
    if(isset($_GET['userId'])) {
        $userData = getUserData($_GET['userId']);  //fun from updateRecord.php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>Registraion</title>
      <link rel="stylesheet" type="text/css" href="css/registeration.css">
</head>
<body>
    <h2> REGISTER  </h2>
    <form method="POST" action ="register.php">
        <div id="register">
            <label>First Name</label>
                <select name="register[prefix]" >
                    <?php $prefixList = ['Mr', 'Miss' , 'Dr' , 'Mrs']; ?>                 
                    <?php foreach($prefixList as $value) :  ?>
                        <?php $selected = (getFieldValue('register', 'prefix') == $value ? "selected" : ""); ?>
                        <option value="<?= $value ?>" <?= $selected ?> > <?= $value ?> </option>
                    <?php endforeach; ?>
                </select> 
            <input type="text" name="register[firstName]" value="<?= getFieldValue('register', 'firstName') ?>">
            <span> <?= validateField('register', 'firstName') ?> </span><br>
            <label>Last Name</label>
            <input type="text" name="register[lastName]"  value=<?= getFieldValue("register", "lastName") ?>>
            <span> <?= validateField('register', 'lastName') ?> </span><br>
            <label>Phone Number</label>
            <input type="number" name="register[phoneNumber]"  value=<?= getFieldValue('register', 'phoneNumber') ?>>
            <span> <?= validateField('register', 'phoneNumber') ?> </span><br>
            <label>Email Id</label>
            <input type="text" name="register[emailAddress]"  value=<?= getFieldValue('register', 'emailAddress') ?> >
            <span> <?= validateField('register', 'emailAddress') ?> </span><br>
            <label>Password</label>
            <input type="password" name="register[password]" value = <?= getFieldValue('register', 'password')?>>
            <span> <?= validateField('register', 'password') ?> </span><br>
            <label>Confirm Password</label>
            <input type="password" name="register[confirmPass]" value= <?= getFieldValue('register', 'password') ?> >
            <span> <?= validateField('register', 'confirmPass') ?> </span><br>
            <label id="specialLbl">Describe Your Self</label>
            <textarea cols="25" rows="4" name="register[selfInfo]" >
                <?= getFieldValue('register', 'selfInfo') ?>
            </textarea>
            <span> <?= validateField('register', 'selfInfo') ?> </span><br><br>
            <input type="checkbox" name="register[chkCondition]" id="chk" required >Hereby , I accept terms and conditions
        </div>
            <?php if(!isset($_GET['userId'])) : ?>
                <input type="submit" name="submit" value="REGISTER" onclick="validateCheckBox();">
                <input type="reset" name="reset" value="RESET">
                <a href="login.php"> BACK </a>
            <?php else : ?>
                <input type="hidden" value="<?= $_GET['userId'] ?>" name="userId">
                <input type="submit" name="updateUser" value="UPDATE USER" onclick="validateCheckBox();">
                <a href="blogPosts.php"> BACK </a>
            <?php endif; ?>
    </form>
    <script>
        function validateCheckBox() {
            if(document.getElementById('chk').checked == false)
            {
                alert('You must agree to the terms first');
                return false;
            }
        }
    </script>
</body>
</html>

<?php
    if(isset($_POST['submit'])) {
        if($flag == 1)
            prepareUserData('insert');
    }
    if(isset($_POST['updateUser'])) {
        if($flag == 1){
            $editUserId = $_POST['userId'];
            prepareUserData('update');
        }
    }
?>