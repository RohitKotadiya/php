<?php $categories = $this->getCategories(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <a href="<?php echo $this->getUrl("add"); ?>"> ADD CATEGORY </a><br><br>

    <form action="<?php echo $this->getUrl("delete") ?>" method="POST">
        <table border="1" width="100%" cellpadding = "5">
            <tr>
                <th></th>
                <th>Id </th>
                <th>Name</th>
                <th>Status</th>
                <th>Path</th>
                <th>Parent Id</th>
                <th>Level</th>
                <th colspan="2">Action</th>
            </tr>
            <?php if($categories == null) :?>
                <tr>
                    <td colspan ="5">Categories Not Found! </td>
                </tr>
            <?php else: ?>
                <?php foreach($categories as $key => $category) : ?>
                    <tr>
                        <td><input type="checkbox" name="categoryIds[]" value="<?php echo $category->id; ?>"></td>
                        <td><?php echo $category->id ?></td>
                        <td><?php echo $this->loadParents($category); ?></td>
                        <td><?php echo $category->status; ?></td>
                        <td><?php echo $category->path ?></td>
                        <td><?php echo $category->parentId; ?></td>
                        <td><?php echo $category->level; ?></td>
                        <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $category->id] )?>">edit</a></td>
                        <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $category->id] )?>">delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <br>
        <input type="submit" name="submit" value="DELETE SELECTED">
    </form>
</body>
</html>