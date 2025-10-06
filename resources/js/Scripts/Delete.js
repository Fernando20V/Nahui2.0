window.openDeleteModal = function(id) {
    document.getElementById('deleteModal-' + id).classList.add('active');
};

window.closeDeleteModal = function(id) {
    document.getElementById('deleteModal-' + id).classList.remove('active');
};

window.confirmDelete = function(id) {
    document.getElementById('delete-form-' + id).submit();
};
