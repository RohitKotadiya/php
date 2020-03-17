<?php $methods = $this->getMethods(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>methods</title>
</head>
<body>
    <a href="<?php echo $this->getUrl("add"); ?>"> ADD METHOD </a><br><br>
    <form method="POST" action="<?php echo $this->getUrl("delete"); ?>">   
        <table border="1" width="100%" cellpadding = "5">
            <tr>
                <th></th>
                <th>Id </th>
                <th>Name</th>
                <th colspan="2">Action</th>
            </tr>
            <?php if($methods == null) :?>
                <tr>
                    <td colspan ="5">methods Not Found! </td>
                </tr>
            <?php else: ?>
                <?php foreach($methods as $key => $method) : ?>
                    <tr>
                        <td><input type="checkbox" name="methodIds[]" value="<?php echo $method->id ?> "></td>
                        <td><?= $method->id ?></td>
                        <td><?= $method->name ?></td>
                        <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $method->id] )?>">edit</a></td>
                        <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $method->id] )?>">delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <br>
        <input type="submit" name="submit" value="DELETE SELECTED">
    </form> 
</body>
</html>