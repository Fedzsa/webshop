class SpecificationRestorer extends ItemRestorer {
    #specificationId;

    constructor(specificationId) {
        super();
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/specifications/${this.#specificationId}/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(
            `#specification-table tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getDeleteMethodDeclarationString() {
        return `deleteSpecification(${this.#specificationId})`;
    }
}
