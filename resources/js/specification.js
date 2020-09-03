function deleteSpecification(id) {
    let specificationRemover = new SpecificationRemover(id);
    specificationRemover.deleteItem();
}

function restoreSpecification(id) {
    let specificationRestorer = new SpecificationRestorer(id);
    specificationRestorer.restoreItem();
}
