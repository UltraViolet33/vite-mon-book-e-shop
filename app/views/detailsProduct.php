<?php $this->view("inc/header", $data); ?>
<div class="row justify-content-center">
    <div class="col-6 text-center">
        <h1>Vite mon Book !</h1>
        <h2>Details Produit</h2>
    </div>
</div>
<div class="container">
    <div class="row justify-content-evenly">
        <div class="col-4">
            <p>Nom Produit : <?= $product->nameProduct ?></p>
            <p>Catégorie Produit : Categorie</p>
            <p>Prix Produit : <?= $product->priceProduct ?></p>
            <p>Description Produit : </p>
            <div>
                <p><?= $product->descriptionProduct ?></p>
            </div>
        </div>
        <div class="col-4">
            <img style="height:130px" src="<?= ASSETS ?>img/products/<?= $product->imageProduct ?>">
        </div>
    </div>
    <div class="row my-5">
        <div class="offset-5">
            <button class="btn btn-primary">Ajouter au panier</button>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>