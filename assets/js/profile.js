const deleteAcc = document.querySelector('#deleteAcc');
const deleteAcc_form = document.querySelector('#deleteAcc_form');

deleteAcc_form.style.display = 'none';

deleteAcc.addEventListener('click', () => {
    deleteAcc_form.style.display = 'block';
});