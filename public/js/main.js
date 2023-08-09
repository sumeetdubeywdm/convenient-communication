document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('editForm');
    const hideavlform = document.getElementById('avlForm');

    if (editButton) {
        editButton.addEventListener('click', function () {
            editForm.style.display = 'block';
            hideavlform.style.display = 'none';
        });
    }
});
