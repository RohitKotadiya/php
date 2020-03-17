<?php $products = $this->getProducts(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Show Product</title>
</head>
<body>
    <a href="<?php echo $this->getUrl("add"); ?>" class="btn btn-primary"> ADD PRODUCT </a><br><br>
    
    <form action="<?php echo $this->getUrl('delete')?>" method="POST">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($products == null) : ?>
                    <tr>
                        <td colspan="6"> Products Not Found! </td>
                    </tr>
                <?php else : ?>
                    <?php foreach($products as $key => $product) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="productIds[]" value="<?= $product->id ?>">
                            </td>
                            <td><?= $product->name ?></td>
                            <td><?= $product->price ?></td>
                            <td><?= $product->stock ?></td>
                            <td><?= $product->description ?></td>
                            <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $product->id]) ?>">edit</a></td>
                            <td><a href="<?php echo $this->getUrl('delete', null, ['id' => $product->id]) ?>">delete</a></td>
                            <td><a href="<?php echo $this->getUrl('viewMediaGallery', 'product_media', ['id' => $product->id]) ?>">Media Gallery</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table><br><br>

        <input type="submit" name="" value="DELETE CHECKED" class="btn btn-primary">
    </form>

   
</body>
</html>