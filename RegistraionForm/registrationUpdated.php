<?php
    require_once "regUpdated_postData.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registraion </title>
        <link rel="stylesheet" type="text/css" href="registraion.css">
    </head>
    <body>
        <form action="registrationUpdated.php" method="POST" enctype="multipart/form-data">
            <fieldset id="account-info">
                <legend>ACCOUNT DETAILS</legend>
                <label>First Name</label>
                <select name="account[prefix]" required>
                    <?php $pre = ['Mr', 'Miss' , 'Dr' , 'Mrs']; ?>                 
                    <?php foreach($pre as $value) :  ?>
                        <option value="<?= $value ?>"><?= $value ?> </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="account[fName]" required value="<?= getFieldValue('account', 'fName'); ?>"><br>
                
                <label>Last Name</label>
                <input type="text" name="account[lName]" required value=<?= getFieldValue("account", "lName"); ?>><br>
                
                <label>Date Of Birth</label>
                <input type="date" name="account[dob]" ><br>
                
                <label>Phone Number</label>
                <input type="number" name="account[phoneNumber]" required><br>

                <label>Email Id</label>
                <input type="email" name="account[emailId]" required><br>

                <label>Password</label>
                <input type="password" name="account[pass]" ><br>

                <label>Confirm Password</label>
                <input type="password" name="account[confirmPass]" ><br>
            <!-- </fieldset>
            <fieldset id="address-info">
                <legend>ADDRESS DETAILS</legend>

                <label>Address Line 1</label>
                <input type="text" name="addressOne" required><br>

                <label>Address Line 2</label>
                <input type="text" name="addressTwo" required><br>

                <label>Company</label>
                <input type="text" name="company" required><br>

                <label>City</label>
                <input type="text" name="city" required><br>

                <label>State</label>
                <input type="text" name="state" required><br>
        
                <label>Country </label>
                <select name="country" required>
                    <option value="India">India</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="Canada">Canada</option>
                </select><br><br>

                <label>Postal Code</label>
                <input type="text" name="postalCode" required><br>
            </fieldset>
            
            <div id="clickCheck">
                <input type="checkbox" name="chkNext" id="chkNext" onchange="showNext();">Check to Fill Other information
            </div>

            <fieldset id="other-info">
                <legend>OTHER INFORMATION</legend>

                <label id="specialLbl">Describe Your Self</label>
                <textarea cols="50" rows="8" name="selfInfo" required></textarea><br><br>

                <label>Profile Picture</label>
                <input type="file" name="profilePicture" required accept="image/*"><br><br>

                <label>Upload Certificate</label>
                <input type="file" name="certificate" required accept=".pdf"><br><br>

                <label>How long have you been in business?</label>
                <input type="radio" name="exp" value="1" required>UNDER 1 Year
                <input type="radio" name="exp" value="2" required>1-2 Year
                <input type="radio" name="exp" value="3" required>2-5 Year
                <input type="radio" name="exp" value="4" required>5-10 Year
                <input type="radio" name="exp" value="5" required>OVER 10 Year <br><br>

                <label>Number of unique clients you see each week?</label>
                <select name="uniqueClient" required>
                    <option value="1-5">1-5</option>
                    <option value="6-10">6-10</option>
                    <option value="11-15">11-15</option>
                    <option value="15+">15+</option>
                </select><br><br>

                <label>How do you like us to get in touch with you?</label>
                <input type="checkbox" name="chkPost">Post
                <input type="checkbox" name="chkEmail">Email
                <input type="checkbox" name="chkSms">SMS
                <input type="checkbox" name="chkPhone">Phone <br><br>

                <label id="specialLbl2">Hobbies</label>
                <select name="hobby" required multiple>
                    <option value="Music">Music</option>
                    <option value="travelling">Travelling</option>
                    <option value="Blogging">Blogging</option>
                    <option value="Sports">Sports</option>
                    <option value="Art">Art</option>
                </select><br><br> -->
                <input type="submit" value="REGISTER" name="submit">          

            <!-- </fieldset> -->
    </form>
    </body>
    <script>
        function showNext() {
            document.getElementById('other-info').style.display = "block";
        }
    </script>
</html>

