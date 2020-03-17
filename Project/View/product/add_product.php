<?php $statusList = $this->getProduct()->getStatusOptions(); ?>
<?php $categoryList = $this->getCategoryList(); ?>
<?php $product = $this->getProduct(); ?>
<?php $productCategory = $this->getProductCategory() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <h1>Product</h1>
    <form action="<?= $this->getUrl('saveProduct', null, ['id' => $product->id])?>" method="POST">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product[name]" id="" value="<?= $product->name ?>">
                </div>
                <div class="form-group">
                   <label>Product Price</label>
                   <input type="text" class="form-control" name="product[price]" id="" value="<?= $product->price?>">
                </div>
                <div class="form-group">
                   <label>Stock</label>
                   <input type="text" class="form-control" name="product[stock]" id="" value="<?= $product->stock?>">
                </div>
                <div class="form-group">
                   <label>Description</label>
                   <input type="text" class="form-control" name="product[description]" id="" value="<?= $product->description ?>">
                </div>
                <div class="form-group">
                   <label>Status</label> 
                   <select name="product[status]" class="form-control">
                        <?php foreach ($statusList as $status => $label) : ?>
                            <?php $selected = ($status == $product->status) ? "selected" : "" ?>
                            <option value="<?= $status  ?>" <?= $selected ?>> <?= $label ?> </option>
                        <?php endforeach; ?>
                        </select>
                    
                </div>
                <div class="form-group">
                   <label>Category</label>
                   <select name="category" class="form-control">
                        <?php foreach($categoryList as $category) : ?>
                            <?php $selected = ($productCategory->categoryId == $category->id) ? "selected" : "" ?>
                            <option value="<?php echo $category->id; ?>" <?= $selected ?>><?php echo $category->name; ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    
                </div>
                <div class="form-group">
                   <input type="submit"  class="btn btn-primary" name="add" id="" value="SAVE">
                </div>
            </div>
        </div>
    </form>
</body>
</html>