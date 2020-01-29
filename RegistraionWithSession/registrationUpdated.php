<?php
    require_once "regUpdated_postData.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registraion </title>
        <link rel="stylesheet" type="text/css" href="registraion.css">
        <style>
            span{
                color : red;
            }
        </style>
    </head>
    <body>
        <form action="registrationUpdated.php" method="POST" enctype="multipart/form-data">
            <fieldset id="account-info">
                <legend>ACCOUNT DETAILS</legend>
                <label>First Name</label>
                <select name="account[prefix]" required>
                    <?php $prefixList = ['Mr', 'Miss' , 'Dr' , 'Mrs']; ?>                 
                    <?php foreach($prefixList as $value) :  ?>
                    <?php $selected = (getFieldValue('account','prefix') == $value ? "selected" : ""); ?>
                        <option value="<?= $value ?>" <?= $selected ?> > <?= $value ?> </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="account[fName]" required value="<?= getFieldValue('account', 'fName') ?>">
                <?php if(in_array("fName" , $errList))   :?>
                    <span>Invalid first Name</span>
                <?php endif; ?><br>
                <label>Last Name</label>
                <input type="text" name="account[lName]" required value=<?= getFieldValue("account", "lName") ?>>
                <?php if(in_array("lName" , $errList))   :?>
                    <span>Invalid last Name</span>
                <?php endif; ?><br>
                <label>Date Of Birth</label>
                <input type="date" name="account[dob]" value=<?= getFieldValue('account', 'dob')?> > <br>
                
                <label>Phone Number</label>
                <input type="number" name="account[phoneNumber]" required value=<?= getFieldValue('account', 'phoneNumber') ?>><br>

                <label>Email Id</label>
                <input type="text" name="account[emailId]" required value=<?= getFieldValue('account', 'emailId') ?> ><br>

                <label>Password</label>
                <input type="password" name="account[pass]" value = <?= getFieldValue('account', 'pass')?>><br>

                <label>Confirm Password</label>
                <input type="password" name="account[confirmPass]" value= <?= getFieldValue('account', 'confirmPass') ?> ><br>
            </fieldset>
            <fieldset id="address-info">
                <legend>ADDRESS DETAILS</legend>

                <label>Address Line 1</label>
                <input type="text" name="address[addressOne]" value= <?= getFieldValue('address', 'addressOne') ?> ><br>

                <label>Address Line 2</label>
                <input type="text" name="address[addressTwo]" value= <?= getFieldValue('address', 'addressTwo') ?> ><br>

                <label>Company</label>
                <input type="text" name="address[company]" value= <?= getFieldValue('address', 'company' ) ?> ><br>

                <label>City</label>
                <input type="text" name="address[city]" value= <?= getFieldValue('address', 'city') ?> ><br>

                <label>State</label>
                <input type="text" name="address[state]" value= <?= getFieldValue('address', 'state') ?> ><br>
        
                <label>Country </label>
                <select name="address[country]" value= <?= getFieldValue('address', 'country') ?> >
                    <?php $countryList = ['India', 'USA', 'UK', 'Canada', 'Brazil', 'Iran']; ?>
                    <?php foreach($countryList as $country) : ?>
                            <?php $selected = (getFieldValue('address', 'country') == $country) ? "selected" : "" ?>
                            <option value="<?= $country ?>" <?= $selected ?> > <?= $country ?> </option>
                        <?php endforeach; ?>
                </select><br><br>

                <label>Postal Code</label>
                <input type="text" name="address[postalCode]" value= <?= getFieldValue('address', 'postalCode') ?> ><br>
            </fieldset> 
          
            <div id="clickCheck">
                <input type="checkbox" name="chkNext" id="chkNext" onchange="showNext();">Check to Fill Other information
            </div>

            <fieldset id="other-info">
                <legend>OTHER INFORMATION</legend>

                <label id="specialLbl">Describe Your Self</label>
                <textarea cols="50" rows="8" name="other[selfInfo]" ><?= getFieldValue('other', 'selfInfo') ?></textarea><br><br>

                <label>Profile Picture</label>
                <input type="file" name="other[profilePicture]" accept="image/*"><br><br>

                <label>Upload Certificate</label>
                <input type="file" name="other[certificate]"  accept=".pdf"><br><br>

                <label>How long have you been in business?</label>
                <?php $expList = ['UNDER 1 YEAR', '1-2 YEAR', '2-5 YEAR', '5-10 YEAR', 'OVER 10 YEAR']; ?>
                <?php foreach($expList as $exp) : ?> 
                    <?php $checkedVal = (getFieldValue('other', 'exp') == $exp ) ? "checked" : "" ?> 
                    <input type="radio" name="other[exp]" value="<?= $exp ?>" <?= $checkedVal ?> ><?= $exp ?>
                <?php endforeach; ?>
                <label>Number of unique clients you see each week?</label>
                <select name="other[uniqueClient]">
                <?php $clientList = ['1-5', '6-10', '11-15', '15+'] ?>
                    <?php foreach($clientList as $client) : ?>
                        <?php $selectedClient = (getFieldValue('other', 'uniqueClient') == $client ) ? "selected" : "" ?>
                        <option value="<?= $client ?>" <?= $selectedClient ?> > <?= $client ?> </option>
                    <?php endforeach; ?>
                </select><br><br>

                <label>How do you like us to get in touch with you?</label>
                <?php $getTouchList = ['Post', 'SMS' , 'Email' , 'Phone']; ?>
                    <?php foreach($getTouchList as $getTouch) : ?>
                        <?php $selectedTouch = array_intersect(getFieldValue('other', 'chkTouch', []),[$getTouch]) ? "checked" : "" ;?>
                        <input type="checkbox" name="other[chkTouch][]" value="<?= $getTouch ?>" <?= $selectedTouch ?> ><?= $getTouch ?>
                    <?php endforeach; ?>
               <br><br>

                <label id="specialLbl2">Hobbies</label>
                <select name="other[hobby][]"  multiple>
                <?php $hobbyList = ['Music', 'Singing', 'Dancing' , 'Reading', 'Sports']; ?>
                    <?php foreach($hobbyList as $hobby) : ?>
                    <?php $selectedHobby = array_intersect(getFieldValue('other', 'hobby'),[$hobby] ) ? "selected" : "" ?>
                    <option value="<?= $hobby ?>" <?= $selectedHobby ?> ><?= $hobby ?></option>
                    <?php endforeach; ?>
                </select><br><br> 
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

