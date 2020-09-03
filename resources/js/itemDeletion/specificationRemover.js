class SpecificationRemover extends TableItemRemover {
    #specificationId

    constructor(specificationId) {
        super();
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/specifications/${this.#specificationId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#specification-table tbody tr[data-specification-id=${this.#specificationId}]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreSpecification(${this.#specificationId})`;
    }
}
