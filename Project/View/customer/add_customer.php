<?php $customer = $this->getCustomer(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
</head>
<body>
    <h1>Customer </h1>
    <form action="<?php echo $this->getUrl('save', null, ['customerId' => $customer->customerId, 'addressId' => $customer->id]); ?>" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="customer[firstName]" id="" value="<?= $customer->firstName ?>">
            </tr>
            <tr>
                <td>Last Name </td>
                <td><input type="text" name="customer[lastName]" id="" value="<?= $customer->lastName ?>">
            </tr>
            <tr>
                <td>emailId</td>
                <td><input type="email" name="customer[emailId]" id="" value="<?= $customer->emailId ?>">
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><input type="text" name="customer[phoneNumber]" id="" value="<?= $customer->phoneNumber?>">
            </tr>
            <tr>
                <td>Password </td>
                <td><input type="text" name="customer[password]" id="" value="<?= $customer->password?>">
            </tr>
            <tr>
                <td>address Line 1</td>
                <td><input type="text" name="address[line1]" id="" value="<?= $customer->line1 ?>">
            </tr> 
            <tr>
                <td>address Line 2</td>
                <td><input type="text" name="address[line2]" id="" value="<?= $customer->line2 ?>">
            </tr> 
            <tr>
                <td>City</td>
                <td><input type="text" name="address[city]" id="" value="<?= $customer->city ?>">
            </tr> 
            <tr>
                <td>zipCode</td>
                <td><input type="text" name="address[zipCode]" id="" value="<?= $customer->zipCode?>">
            </tr>     
            <tr>
                <td colspan="2"><input type="submit" name="add" id="" value="SAVE">
            </tr>
        </table>
 </form>
</body>
</html>