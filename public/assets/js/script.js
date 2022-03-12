


/**
 * disPlayForm
 * add or remove the showFormCat css class to the aff form categories in admin
 * @return 
 */
function displayForm()
{
    const formCat_div = document.querySelector('.formCat');
    formCat_div.classList.toggle('showFormCat');
}