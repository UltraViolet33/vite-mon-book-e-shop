<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Add Products - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom Produit : </label>
                    <input type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : " "; ?>" name='name' class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie Produit : </label>
                    <select name="category" class="form-select">
                        <option selected>Choississez une catégorie</option>
                        <?php if (isset($selectHTML)) {
                            echo $selectHTML;
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prix Produit : </label>
                    <input type="number" value="<?= isset($_POST['price']) ? $_POST['price'] : " "; ?>" name='price' class="form-control">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock actuel : </label>
                    <input type="number" value="<?= isset($_POST['stock']) ? $_POST['stock'] : " "; ?>" name='stock' class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description : </label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choississez une image : </label>
                    <input name="image" class="form-control" type="file" accept="image/png, image/jpeg">
                </div>
                <input type="submit" class="btn btn-primary" name="signUp" value="Valider">
            </form>
            <?= checkError() ?>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>