function deleteProduct(productId) {
    let productRemover = new ProductRemover(productId);
    productRemover.deleteItem();
}

function restoreProduct(productId) {
    let productRestorer = new ProductRestorer(productId);
    productRestorer.restoreItem();
}
