class ProductSpecificationRestorer extends ItemRestorer {
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
        }/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(
            `#product-specification-table tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getDeleteMethodDeclarationString() {
        return `deleteProductSpecification(${this.#specificationId})`;
    }
}
