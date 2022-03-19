<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-6">
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/categories">View Categories</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/products">View Products</a></button>
            <button class="btn btn-primary"> <a href="<?= ROOT ?>admin/commands">View Commands</a></button>
        </div>
    </div>
</div>
<?php $this->view("inc/footer", $data); ?>