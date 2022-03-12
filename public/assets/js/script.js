/**
 * disPlayForm
 * add or remove the showFormCat css class to the aff form categories in admin
 * @return
 */
function displayForm() {
  const formCat_div = document.querySelector(".formCat");
  formCat_div.classList.toggle("showFormCat");
}
/**
 * sendDataAjax
 * send the data to the Ajax controller PHP
 * @param  {object} data={}
 * @return void
 */
function sendDataAjax(data = {}) {
  const ajax = new XMLHttpRequest();
  ajax.onload = function () {
    alert(ajax.responseText);
  };
  ajax.open("POST", "<?= ROOT ?>ajax", true);
  ajax.send(JSON.stringify(data));
}

/**
 * collectDataCat
 * get the input of add cat form
 * and send the data with sendDataAjax
 * @return void
 */
function collectDataCat() {
  const categoryAdd_input = document.getElementById("inputAddCat");

  if (
    categoryAdd_input.value.trim() == "" ||
    !isNaN(categoryAdd_input.value.trim())
  ) {
    alert("Entrez un nom de categorie valide !");
  } else {
    const data = categoryAdd_input.value.trim();
    console.log(data);
    const objData = {
      data: data,
      dataType: "addCategory",
    };
    console.table(objData);
    sendDataAjax(objData);
  }
}
