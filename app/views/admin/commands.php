<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Commands - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID User</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date de la commande</th>
                        <th scope="col">Etat de la commande</th>
                    </tr>
                </thead>
                <tbody id="tableProducts">
                    <?php
                    echo $commandsHTML;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>