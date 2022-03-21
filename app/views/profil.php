<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-8 text-center">
            <h1 class="">Informations Profil <?= $data['userData']->firstnameMember ?> <?= $data['userData']->nameMember ?> </h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="offset-2 col-4 infos">
            <h3>Informations générales</h3>
            <p>Nom : <span class="bold"> <?= $data['userData']->nameMember ?></span></p>
            <p>Prénom : <span class="bold"> <?= $data['userData']->firstnameMember ?></span></p>
            <p>Pseudo : <span class="bold"><?= $data['userData']->pseudoMember ?> </span></p>
            <p>Email :<span class="bold"> <?= $data['userData']->emailMember ?></span></p>
        </div>
        <div class="offset-2 col-4 infos">
            <h3>Autres informations</h3>
            <p>Ville : <span class="bold"> <?= $data['userData']->cityMember ?></span></p>
            <p>Code Postal : <span class="bold"> <?= $data['userData']->postalCodeMember ?></span></p>
            <p>Adresse :<span class="bold"> <?= $data['userData']->adressMember ?> </span></p>
        </div>
    </div>
    <div class="row my-5">
        <div class="offset-4">
            <button class="btn btn-primary"><a href="<?= ROOT ?>profil/update">Modifier</a></button>
            <button class="btn btn-primary"><a href="<?= ROOT ?>profil/commands">Voir mes commandes</a></button>
            <button class="btn btn-danger"><a href="<?= ROOT ?>profil/delete">Supprimer</a></button>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>