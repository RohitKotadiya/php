<?php $paymentMethod = $this->getMethod(); ?>
<?php $statusList = $this->getMethod()->getStatusOptions(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Method</title>
</head>
<body>
    <h1> Payment Method </h1>
    <form action="<?= $this->getController()->getUrl('save', null, ['id' => $paymentMethod->id]);?>" method="POST">
        <table>
            <tr>
                <td>Name </td>
                <td><input type="text" name="paymentMethod[name]" id="" value="<?= $paymentMethod->name ?>">
            </tr>
            <tr>
                <td>Status </td>
                <td><select name="paymentMethod[status]">
                    <?php foreach($statusList as $status => $statusLabel) : ?>
                        <?php $selected = ($status == $paymentMethod->status ) ? "selected" : "" ?>
                        <option value = "<?= $status ?>" <?= $selected ?> > <?= $statusLabel ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="add" id="" value="SAVE">
            </tr>
        </table>
    </form>
</body>
</html>