<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-8 text-center">
            <h1 class="">Commandes </h1>
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date de la commande</th>
                            <th scope="col">Montant de la command</th>
                            <th scope="col">Etat de la commande</th>
                        </tr>
                    </thead>
                    <tbody id="tableCategories">
                        <?php
                         echo $commands;
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
</div>
<?php $this->view("inc/footer", $data); ?>