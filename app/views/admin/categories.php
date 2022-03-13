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

        <div class="row justify-content-center">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody id="tableCategories">
                        <?php
                        echo $tableHTML;
                        ?>
                    </tbody>
                </table>

            </div>
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
            //alert(ajax.responseText);
            handleResultAjax(ajax.responseText);
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

    /**
     * handleResultAjax
     * get the result from PHP and update the HTML table for categories
     * @return void
     */
    function handleResultAjax(result) {
        console.log('azeghk')
        if (result != "") {
            let resultObj = JSON.parse(result);

            if (typeof resultObj.dataType != "undefined") {
                if (resultObj.dataType == "addCategory") {
                    if (resultObj.messageType == "info") {
                        displayForm();
                        const tableCategories_tbody = document.querySelector('#tableCategories');
                        tableCategories_tbody.innerHTML = resultObj.data;
                    }
                }
            }
        }
    }
</script>
<?php $this->view("inc/footer", $data); ?>