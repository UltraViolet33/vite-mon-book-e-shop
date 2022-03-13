<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-8 text-center">
            <h1 class="">Votre Panier</h1>
        </div>
    </div>
    <?php
    if (empty($_SESSION['cart']['idProduct'])) {
        echo "pas de panier";
    } else {
        echo "panier";
    }
    ?>
</div>
<?php $this->view("inc/footer", $data); ?>