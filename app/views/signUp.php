<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Inscription</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Votre nom : </label>
                        <input type="text" value="<?= isset($_POST['username']) ? $_POST['username'] : " "; ?>" name='username' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Votre email : </label>
                        <input type="text" value="<?= isset($_POST['email']) ? $_POST['email'] : " "; ?>" name='email' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Votre mot de passe : </label>
                        <input type="password" name='password' class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confimez le mot de passe : </label>
                        <input type="password" name='password2' class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" name="valider" value="valider">
                </form>
                <span style="font-size:24px; color:red"><?php checkError() ?></span>
            </div>
        </div>
    </div>
</div>
<?php $this->view("inc/header", $data); ?>