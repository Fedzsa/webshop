class ProductSpecificationRemover extends TableItemRemover {
    #productId;
    #specificationId;

    constructor(productId, specificationId) {
        super();
        this.#productId = productId;
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/products/${this.#productId}/specifications/${
            this.#specificationId
        }`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#product-specification-table tbody tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreProductSpecification(${this.#productId}, ${
            this.#specificationId
        })`;
    }
}
