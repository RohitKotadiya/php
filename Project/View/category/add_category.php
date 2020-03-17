<?php $statusList = $this->getCategory()->getStatusOptions(); ?>
<?php $category = $this->getCategory(); ?>
<?php $parentCategories = $this->getParentCategories(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>
<body>
    <h1> Category </h1>
    <form action="<?= $this->getUrl('save', null, ['id' => $category->id]);?>" method="POST">
        <table>
            <tr>
                <td>Category Name </td>
                <td><input type="text" name="category[name]" id="" value="<?= $category->name ?>">
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="category[description]" id="" value="<?= $category->description ?>">
            </tr>
            <tr>
                <td>Parent Category</td>
                <td>
                    <select name="category[parentId]">
                        <option value="0"> None </option>
                        <?php foreach ($parentCategories as $parentId => $parentCategory) : ?>
                            <?php $selected = ($parentId == $category->parentId) ? "selected" : ""; ?>
                            <option value="<?php echo $parentId ?>" <?php echo $selected; ?>><?php echo $parentCategory?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status </td>
                <td><select name="category[status]">
                    <?php foreach($statusList as $status => $statusLabel) : ?>
                        <?php $selected = ($status == $category->status ) ? "selected" : "" ?>
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