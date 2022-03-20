<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Users - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-5">
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/">View Users</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/viewAdmins">View Admins</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/users/viewCustomers">View Customers</a></button>
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
                        <th scope="col">Adress</th>
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
</div>
<?php $this->view("inc/footer", $data); ?>