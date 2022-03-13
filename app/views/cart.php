<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-8 text-center">
            <h1 class="">Votre Panier</h1>
        </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom du produit</th>
                <th scope="col">Quantité</th>
                <th scope="col">prix</th>
            </tr>
        </thead>
        <tbody>

            <?php
            echo $cart;
            ?>


        </tbody>
    </table>
    <button><a href="<?= ROOT ?>cart/deleteCart">Supprimer le panier</a></button>
    <?php

    if (isset($button)) {
        echo $button;
    }

    ?>
</div>
<?php $this->view("inc/footer", $data); ?>