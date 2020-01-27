<?php
    session_start();
    extract($_POST);

    $fNameErr = $lNameErr = $phoneErr = $emailErr = $dobErr = $userPaasErr = $companyErr = $addErr = $cityErr = $stateErr = $countryErr = "";
    $zipCodeErr = $getTouchErr = $dpErr = $selfInfoErr = $docErr = $userExpErr = $hobbyErr = $userClientErr = "";
    $userData = [];
   
    $regExNum = '/[0-9]/';
    $regExName = '/[a-zA-Z]/';
    
    if(isset($submit)) {

        if(isset($prefix)) {
            $userData['prefix'] = $prefix;
        }
        if(isset($fName) && !empty($fName) && isset($lName) && !empty($lName)) {
            if(!preg_match($regExName, $fName)) {
                $fNameErr =  "Enter valid First Name";            
            }else {
                $userData["firstName"] = $fName;
            }  
            if(!preg_match($regExName, $lName)) {
                $lNameErr = "Enter Valid last name";
            }else {
                $userData["lastName"] = $lName;
            }
        }
        if(isset($phoneNumber) && isset($emailId) && isset($dob)) {
            if(!preg_match($regExNum, $phoneNumber) || strlen($phoneNumber) != 10) {
                $phoneErr = "Enter valid Phone Number";
            }else if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Enter valid Email id";          
            }else {
                $userData['mobileNo'] = $phoneNumber;
                $userData['email'] = $emailId;
                $userData['dateOfBirth'] = $dob;
            }   
        }
        if(isset($pass) && isset($confirmPass)) {
            if(strlen($pass) < 8 || strlen($confirmPass) < 8 || $pass !== $confirmPass) {
                $userPaasErr = "Enter valid Password";
            }else {
                $userData['userPass'] = $pass;
            }
        }
        if(!empty($addressOne) && !empty($addressTwo)) {
            $userData['addLine1'] = $addressOne;
            $userData['addLine2'] = $addressTwo;
        }else {
            $addErr = "Please Enter the address ";
        }
        if(isset($company) && !empty($company)) {
            $userData['companyName'] = $company;
        }else{
            $companyErr =  "Please Enter the company";
        }
        if(!isset($city) || empty($city) || !preg_match($regExName, $city)) {
            $cityErr = "Enter valid  city";
        }else {
            $userData['userCity'] = $city;
        }
        if(!isset($state) || empty($state) || !preg_match($regExName, $state)) {
            $stateErr =  "Enter valid state name";
        }else {
            $userData['userState'] = $state;
        }
        if(!isset($country) || empty($country)){
            $countryErr =  "Please Enter the country";
        }else {
            $userData['userCountry'] = $country;
        }
        if(empty($postalCode) || !preg_match($regExNum, $postalCode) || strlen($postalCode) != 6) {
            $zipCodeErr =  "Enter valid Postal Code";
        }else {
            $userData['userZipCode'] = $postalCode;
        }
        if(empty($selfInfo) || !isset($selfInfo)) {
            $selfInfoErr =  "Please Write Something about you";
        }else {
            $userData['selfData'] = $selfInfo;
        }
        if(!isset($profilePicture)) {
            $dpErr = "Please select Your Profile";
        }else {
            $dpPath = explode(".", $profilePicture);
            if($dpPath[1] === 'jpg' || $dpPath[1] === 'jpeg') {
                $userData['dpPath'] = $dpPath;
            }else {
                $dpErr =  "Please select valid Profile Picture";
            }
        }
        if(!isset($certificate)) {
            $docErr = "Please select document";
        }else {
            $userDocPath = explode(".", $certificate);
            echo $userDocPath[1];
            if($userDocPath[1] === 'pdf') {
                echo $userDocPath[1];
                $userData['userDoc'] = $userDocPath;
            }else {
                $docErr =  "Please select valid Certificate";
            }   
        }
        if(isset($exp)) {
            $userData['userExp'] = $exp;
        }else {
            $userExpErr = "Please select one of below options";
        }
        if(isset($uniqueClient) && !empty($uniqueClient)) {
            $userData['userClient'] =  $uniqueClient;
        }else {
            $userClientErr =  "Please select one of all unique client";
        }
        if(!empty($_POST['chkPost'])){
            $userData['getTouch'] = $chkPost; 
        }else {
            $getTouchErr = "select atleast one option to get in touch";
        }
        if(isset($_POST['hobby'])){
            $userData['hobbies'] = $hobby;
        }else {
            $hobbyErr = "Please select atleast one hobby";
        }
    
        $_SESSION['userInfo'] = $userData;
    }elseif(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo'])) {
        $userData = $_SESSION['userInfo'];
    }else {
        echo "Fill the form first";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registraion </title>
        <link rel="stylesheet" type="text/css" href="registraion.css">
        <style>
            span{
                color:red;
            }
        </style>
    </head>
    <body>
        <form action="registration.php" method="POST">
            <fieldset id="account-info">
                <legend>ACCOUNT DETAILS</legend>
                 <label>First Name</label>
                <select name="prefix" required>
                    <option value="mr">Mr.</option>
                    <option value="miss">Miss.</option>
                    <option value="ms">Ms.</option>
                    <option value="mrs">Mrs.</option>
                    <option value="dr">Dr.</option>
                </select>
                <input type="text" name="fName" value="<?php if(!empty($userData["firstName"])) echo $userData["firstName"]; ?>" required>
                <span><?= $fNameErr ?></span><br>
                
                <label>Last Name</label>
                <input type="text" name="lName" value="<?php if(!empty($userData["lastName"])) echo $userData['lastName']; ?>" required>
                <span><?= $lNameErr ?></span><br> 
      
                <label>Date Of Birth</label>
                <input type="date" name="dob" value="<?php if(!empty($userData["dateOfBirth"])) echo $userData["dateOfBirth"]; ?>" required>
                <span><?= $dobErr ?></span><br>
                
                <label>Phone Number</label>
                <input type="number" name="phoneNumber" value="<?php if(!empty($userData["mobileNo"])) echo $userData["mobileNo"]; ?>" required><span><?= $phoneErr ?></span><br>

                <label>Email Id</label>
                <input type="email" name="emailId" value="<?php if(!empty($userData["email"])) echo $userData["email"]; ?>" required><span><?= $emailErr ?></span><br>

                <label>Password</label>
                <input type="password" name="pass" value="<?php if(!empty($userData["userPass"])) echo $userData["userPass"]; ?>" required><span><?= $userPaasErr ?></span><br>

                <label>Confirm Password</label>
                <input type="password" name="confirmPass" value="<?php if(!empty($userData["userPass"])) echo $userData["userPass"]; ?>" required><span><?= $userPaasErr ?></span><br>
            </fieldset> 
            <fieldset id="address-info">
                <legend>ADDRESS DETAILS</legend>

                <label>Address Line 1</label>
                <input type="text" name="addressOne" value="<?php if(!empty($userData["addLine1"])) echo $userData["addLine1"]; ?>" required><br>

                <label>Address Line 2</label>
                <input type="text" name="addressTwo" value="<?php if(!empty($userData["addLine2"])) echo $userData["addLine2"]; ?>" required><span><?= $addErr ?></span><br>

                <label>Company</label>
                <input type="text" name="company" value="<?php if(!empty($userData["companyName"])) echo $userData["companyName"]; ?>" required><span><?= $companyErr ?></span><br>

                <label>City</label>
                <input type="text" name="city" value="<?php if(!empty($userData["userCity"])) echo $userData["userCity"]; ?>" required><span><?= $cityErr ?></span><br>

                <label>State</label>
                <input type="text" name="state" value="<?php if(!empty($userData["userState"])) echo $userData["userState"]; ?>" required><span><?= $stateErr ?></span><br>
        
                <label>Country </label>
                <select name="country" required>
                    <option value="" selected ="" disabled="">Country</option>
                    <option value="India" <?php if(!empty($userData['userCountry']) && $userData['userCountry']  == "India") echo "selected"; ?>>India</option>
                    <option value="USA" <?php if(!empty($userData['userCountry']) && $userData['userCountry']  == "USA") echo "selected"; ?>>USA</option>
                    <option value="UK" <?php if(!empty($userData['userCountry']) && $userData['userCountry']  == "UK") echo "selected"; ?>>UK</option>
                    <option value="Canada" <?php if(!empty($userData['userCountry']) && $userData['userCountry']  == "Canada") echo "selected"; ?>>Canada</option>
                </select><span><?= $countryErr ?></span><br><br>

                <label>Postal Code</label>
                <input type="text" name="postalCode" value="<?php if(!empty($userData["userZipCode"])) echo $userData["userZipCode"]; ?>" required><span><?= $zipCodeErr ?></span><br>
            </fieldset>
          
            <div id="clickCheck">
                <input type="checkbox" name="chkNext" id="chkNext" onchange="showNext();">Check to Fill Other information
            </div>
            
            <fieldset id="other-info">
                <legend>OTHER INFORMATION</legend>

                <label id="specialLbl">Describe Your Self</label>
                <textarea cols="50" rows="8" name="selfInfo" required><?php if(!empty($userData["selfData"])) echo $userData["selfData"]; ?></textarea><span><?= $selfInfoErr ?></span><br><br>
        
                <label>Profile Picture</label>
                <input type="file" name="profilePicture" required accept="image/*"><span><?= $dpErr ?></span>
                <br><br>
                <label>Upload Certificate</label>
                <input type="file" name="certificate" value="<?= $userData['userDoc'] ?>" required accept=".pdf"><span><?= $docErr ?></span>
                <br><br>

                <label>How long have you been in business?</label>
                <input type="radio" name="exp" value="1" required <?php if(!empty($userData['userExp']) && $userData['userExp']  == 1) echo "checked"; ?>>UNDER 1 Year
                <input type="radio" name="exp" value="2" required <?php if(!empty($userData['userExp']) && $userData['userExp']  == 2) echo "checked"; ?>>1-2 Year
                <input type="radio" name="exp" value="3" required <?php if(!empty($userData['userExp']) && $userData['userExp']  == 3) echo "checked"; ?>>2-5 Year
                <input type="radio" name="exp" value="4" required <?php if(!empty($userData['userExp']) && $userData['userExp']  == 4) echo "checked"; ?>>5-10 Year
                <input type="radio" name="exp" value="5" required <?php if(!empty($userData['userExp']) && $userData['userExp']  == 5) echo "checked"; ?>>OVER 10 Year 
                <span><?= $userExpErr ?></span><br><br>
 
                <label>Number of unique clients you see each week?</label>
                <select name="uniqueClient" required>
                    <option value="" disabled="" selected="">unique Client</option>
                    <option value="1" <?php if(!empty($userData['userClient']) && $userData['userClient']  == 1) echo "selected"; ?>>1-5</option>
                    <option value="2" <?php if(!empty($userData['userClient']) && $userData['userClient']  == 2) echo "selected"; ?>>6-10</option>
                    <option value="3" <?php if(!empty($userData['userClient']) && $userData['userClient']  == 3) echo "selected"; ?>>11-15</option>
                    <option value="4" <?php if(!empty($userData['userClient']) && $userData['userClient']  == 4) echo "selected"; ?>>15+</option>
                </select><span><?= $userClientErr ?></span><br><br>

                <label>How do you like us to get in touch with you?</label>
                <input type="checkbox" name="chkPost[]" value="Post" <?php if(!empty($userData['getTouch']) && in_array('Post', $userData['getTouch'])) echo "checked"; ?>>Post
                <input type="checkbox" name="chkPost[]" value="Email" <?php if(!empty($userData['getTouch']) && in_array('Email', $userData['getTouch'])) echo "checked"; ?>>Email
                <input type="checkbox" name="chkPost[]" value="SMS" <?php if(!empty($userData['getTouch']) && in_array('SMS', $userData['getTouch'])) echo "checked"; ?>>SMS
                <input type="checkbox" name="chkPost[]" value="Phone" <?php if(!empty($userData['getTouch']) && in_array('Phone', $userData['getTouch'])) echo "checked"; ?>>Phone
                <span><?= $getTouchErr ?></span> <br><br>

                <label id="specialLbl2">Hobbies</label>
                <select name="hobby[]" required multiple>
                    <option value="Music" <?php if(!empty($userData['hobbies']) && in_array('Music', $userData['hobbies'])) echo "selected"; ?>>Music</option>
                    <option value="travelling" <?php if(!empty($userData['hobbies']) && in_array('travelling', $userData['hobbies'])) echo "selected"; ?>>Travelling</option>
                    <option value="Blogging" <?php if(!empty($userData['hobbies']) && in_array('Blogging', $userData['hobbies'])) echo "selected"; ?>>Blogging</option>
                    <option value="Sports" <?php if(!empty($userData['hobbies']) && in_array("Sports", $userData['hobbies'])) echo "selected"; ?>>Sports</option>
                    <option value="Art" <?php if(!empty($userData['hobbies']) && in_array('Art', $userData['hobbies'])) echo "selected"; ?>>Art</option>
                </select><span><?= $hobbyErr ?></span><br><br>
                <input type="submit" value="REGISTER" name="submit">          

            </fieldset>
    </form>
    </body>
    <script>
        function showNext() {
            document.getElementById('other-info').style.display = "block";
        }
    </script>
</html>