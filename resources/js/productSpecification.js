function deleteProductSpecification(productId, specificationId) {
    let productSpecificationRemover = new ProductSpecificationRemover(productId, specificationId);
    productSpecificationRemover.deleteItem();
}

function restoreProductSpecification(productId, specificationId) {
    let productSpecificationRestorer = new ProductSpecificationRestorer(productId, specificationId);
    productSpecificationRestorer.restoreItem();
}
