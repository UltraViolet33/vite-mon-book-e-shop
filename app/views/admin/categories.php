<?php $this->view("inc/header", $data); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Categories - Admin</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <button class="btn btn-primary" onclick="displayForm()">Ajouter Catégorie</button>
        </div>
        <div class="col-8 formCat">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la catégorie : </label>
                    <input id="inputAddCat" type="text" name='name' class="form-control">
                </div>
                <button type="button" onclick="collectDataCat()" class="btn btn-primary">Valider</button>
                <button type="button" onclick="displayForm()" class="btn btn-warning">Fermer</button>
            </form>
        </div>
    </div>
</div>
<script>
    /**
     * sendDataAjax
     * send the data to the Ajax controller PHP
     * @param  {object} data={}
     * @return void
     */
    function sendDataAjax(data = {}) {
        const ajax = new XMLHttpRequest();
        ajax.onload = function() {
            alert(ajax.responseText);
        };

        // ajax.addEventListener('readystatechange', function() {
        //     if (ajax.readyState == 4 && ajax.status == 200) {
        //         alert(ajax.responseText);
        //     }
        // });

        ajax.open("POST", "<?= ROOT ?>categoryAjax", true);
        ajax.setRequestHeader("Content-type", "application/json");
        ajax.send(JSON.stringify(data));

    }
</script>
<?php $this->view("inc/footer", $data); ?>