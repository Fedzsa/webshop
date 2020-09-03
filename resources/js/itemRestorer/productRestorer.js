class ProductRestorer extends ItemRestorer {
    #productId

    constructor(productId) {
        super();
        this.#productId = productId;
    }

    getUrl() {
        return `/products/${this.#productId}/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(`#product-table tr[data-product-id=${this.#productId}]`);
    }

    getDeleteMethodDeclarationString() {
        return `deleteProduct(${this.#productId})`;
    }
}
