<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite mon Book - <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ASSETS ?>css/main.css">
</head>

<body style="overflow-x:hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?= ROOT ?>home">Vite mon Book !</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= ROOT ?>products">Produits</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= ROOT ?>cart">Panier</a>
                                </li>
                                <?php if (isset($data['userData'])) : ?>
                                    <li class="nav-item">
                                        <a href="<?= ROOT ?>profil" class="nav-link"><?= $data['userData']->pseudoMember ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>logout">Logout</a>
                                    </li>
                                <?php else :; ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>login">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>signUp">SignUp</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <?php if ((isset($data['userData'])) && ($data['userData']->isAdmin)) : ?>
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="admin">Admin Part</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>admin/categories">View Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>admin/products">View Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>admin/commands">View Commands</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= ROOT ?>admin/users">View Users</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>