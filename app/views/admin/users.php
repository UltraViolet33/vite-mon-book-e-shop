<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Utilisateurs - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-5">
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/">Voir les utilisateurs</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/viewAdmins">Voir les admin</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/viewCustomers">Voir les clients</a></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ville</th>
                        <th scope="col">Code Postal</th>
                        <th scope="col">Adresse</th>
                    </tr>
                </thead>
                <tbody id="tableProducts">
                    <?php
                    echo $users;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
                    echo $noCus;
                    ?>
</div>
<?php $this->view("inc/footer", $data); ?>