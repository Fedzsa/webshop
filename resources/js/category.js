function deleteCategory(id) {
    let categoryRemover = new CategoryRemover(id);
    categoryRemover.deleteItem();
}

function restoreCategory(id) {
    let categoryRestorer = new CategoryRestorer(id);
    categoryRestorer.restoreItem();
}
