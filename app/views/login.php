<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Connexion</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email : </label>
                        <input type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ""; ?>" name='email' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe : </label>
                        <input type="password" name='password' class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" name="login" value="Valider">
                </form>
                <?= checkError() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>