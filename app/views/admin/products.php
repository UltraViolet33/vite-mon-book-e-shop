<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Products - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <button class="btn btn-primary"><a href="<?= ROOT ?>admin/products/add">Ajouter Produit</a> </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Image</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody id="tableProducts">
                    <?php
                    echo $tableHTML;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>