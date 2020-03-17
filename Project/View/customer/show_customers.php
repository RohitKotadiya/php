<?php $customers = $this->getCustomers(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
</head>
<body>
    <a href="<?php echo $this->getUrl('add'); ?>"> ADD CUSTOMER </a><br><br>

    <form method="POST" action="<?php echo $this->getUrl("delete"); ?>">
        <table border="1" width="100%" cellpadding = "5">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone Number</th>
                <th colspan="2">Action</th>
            </tr>
            <?php if($customers == null) : ?>
                <tr>
                    <td colspan="5"> Customers No Found! </td>
                </tr>
            <?php else: ?>
                <?php foreach($customers as $key => $customer) : ?>
                    <tr>
                        <td><input type="checkbox" name="customerIds[]" value="<?php echo $customer->customerId ?>"></td>
                        <td><?= $customer->firstName . " " . $customer->lastName ?></td>
                        <td><?= $customer->emailId ?></td>
                        <td><?= $customer->city ?></td>
                        <td><?= $customer->phoneNumber?></td>
                        <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $customer->customerId] )?>">edit</a></td>
                        <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $customer->customerId] )?>">delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <br>
        <input type="submit" name="submit" value="DELETE SELECTED">
    </form>
</body>
</html>
